<?php

namespace SchoolSpider\SpiderEditor\Core;

use SchoolSpider\SpiderEditor\Nodes\Audio;
use SchoolSpider\SpiderEditor\Nodes\Files;
use SchoolSpider\SpiderEditor\Nodes\Image;
use SchoolSpider\SpiderEditor\Nodes\Table;
use SchoolSpider\SpiderEditor\Nodes\Video;
use SchoolSpider\SpiderEditor\Nodes\Column;
use SchoolSpider\SpiderEditor\Nodes\Layout;
use SchoolSpider\SpiderEditor\Nodes\Content;
use SchoolSpider\SpiderEditor\Nodes\Heading;
use SchoolSpider\SpiderEditor\Nodes\Carousel;
use SchoolSpider\SpiderEditor\Nodes\Slideshow;

class DOMSerialiser
{
    public function __construct(protected array $document = [])
    {
    }

    public function process()
    {
        $html = [];

        foreach ($this->document as $node) {
            $html[] = $this->parseNode($node);
        }

        return implode("\n\n", $html);
    }

    public function parseNode($node)
    {
        $html = [];

        $html[] = match ($node['type']) {
            'heading' => $this->parseHeading($node),
            'content' => $this->parseContent($node),
            'layout' => $this->parseLayout($node),
            'column' => $this->parseColumn($node),
            'image' => $this->parseImage($node),
            'files' => $this->parseFiles($node),
            'slideshow' => $this->parseSlideshow($node),
            'carousel' => $this->parseCarousel($node),
            'video' => $this->parseVideo($node),
            'audio' => $this->parseAudio($node),
            'table' => $this->parseTable($node),
            default => ''
        };

        return implode($html);
    }

    private function parseHeading($node)
    {

        return (new Heading($node))->render();

    }

    private function parseContent($node)
    {
        return (new Content($node))->render();
    }

    private function parseLayout($node)
    {
        return (new Layout($node))->addClass('dd-layout')->render();
    }

    private function parseColumn($node)
    {
        return (new Column($node))->addClass('dd-column')->render();
    }

    private function parseImage($node)
    {
        return (new Image($node))->addClass('dd-image')->render();
    }

    private function parseFiles($node)
    {
        return (new Files($node))->addClass('file_gallery')->render();
    }

    private function parseSlideshow($node)
    {
        return (new Slideshow($node))->addClass('dd-slideshow')->render();
    }

    private function parseCarousel($node)
    {
        return (new Carousel($node))->addClass('dd-carousel')->render();
    }

    public function parseVideo($node)
    {
        return (new Video($node))->addClass('dd-video')->render();
    }

    public function parseAudio($node)
    {
        return (new Audio($node))->addClass('dd-audio')->render();
    }

    public function parseTable($node)
    {
        return (new Table($node))->addClass('dd-table')->render();
    }
}
