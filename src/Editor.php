<?php

namespace SchoolSpider\SpiderEditor;

use Exception;
use SchoolSpider\SpiderEditor\Core\DOMSerialiser;

class Editor
{
    protected $config = [];

    protected $document = [];

    public function __construct(array $config = [])
    {

    }

    public function setContent($value): self
    {

        match ($this->getContentType($value)) {
            'JSON' => $this->document = json_decode($value, true),
            'HTML' => $this->document = $value,
            'Array' => $this->document = json_decode(json_encode($value), true),
        };

        return $this;
    }

    public function flattenNodes()
    {
        return collect($this->document)->flatMap(function ($node) {

            if ($this->isFlat($node)) {
                return [$node];
            }

            return $this->walkChildren($node);
        });
    }

    public function isFlat($node)
    {
        return ! in_array($node['type'], ['layout', 'column']);
    }

    public function walkChildren($node)
    {
        return collect($node['children'])
            ->flatMap(function ($node) {

                if ($this->isFlat($node)) {
                    return [$node];
                }

                return $this->walkChildren($node);
            })
            ->toArray();
    }

    public function has($key): bool
    {
        return $this->flattenNodes()->where('type', $key)->isNotEmpty();
    }

    public function hasCarousel(): bool
    {
        return $this->has('carousel');
    }

    public function hasSlideshow(): bool
    {
        return $this->has('slideshow');
    }

    public function hasAudio(): bool
    {
        return $this->has('audio');
    }

    public function getImages()
    {
        return $this->flattenNodes()->filter(function ($node) {
            return in_array($node['type'], ['image', 'slideshow', 'carousel']);
        })->flatMap(function ($node) {

            if ($node['type'] === 'image') {
                return [$node['content']['src']];
            }

            if ($node['type'] === 'slideshow') {
                return collect($node['content'])->flatMap(function ($slide) {
                    return [
                        $slide['src'],
                        $slide['thumbnail'],
                    ];
                });
            }

            if ($node['type'] === 'carousel') {
                return collect($node['content'])->flatMap(function ($slide) {
                    return [$slide['src']];
                });
            }

        });
    }

    public function toHTML()
    {
        return (new DOMSerialiser($this->document))->process();
    }

    public function getContentType($value): string
    {

        if (is_string($value)) {
            try {
                /**
                 * @psalm-suppress UnusedFunctionCall
                 */
                json_decode($value, true, 512, JSON_THROW_ON_ERROR);

                return 'JSON';
            } catch (Exception $exception) {
                return 'HTML';
            }
        }

        if (is_array($value)) {
            return 'Array';
        }

        throw new Exception('Unknown format passed to setContent(). Try passing HTML, JSON or an Array.');
    }
}
