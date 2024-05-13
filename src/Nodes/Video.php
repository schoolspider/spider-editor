<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Video extends Node
{
    protected $type = 'video';

    public function getSrc()
    {
        $content = $this->node['content']['src'] ?? '';

        if ($this->getType() === 'embed') {
            $dom = new \DOMDocument();
            @$dom->loadHTML($content);

            $iframe = $dom->getElementsByTagName('iframe')->item(0);

            if (! $iframe) {
                @$dom->loadHTML('<iframe src="'.$content.'" allowfullscreen frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>');
                $iframe = $dom->getElementsByTagName('iframe')->item(0);
            }

            $iframe?->removeAttribute('width');
            $iframe?->removeAttribute('height');

            $content = $dom->saveHTML($iframe);
        }

        return $content;
    }

    public function getName()
    {
        return $this->node['content']['name'] ?? '';
    }

    public function getType()
    {
        return $this->node['content']['type'] ?? 'stored';
    }

    public function render()
    {
        if (in_array($this->getType(), ['stored', 'file'])) {

            return <<<EOT
            <div class="dd-video-container">
                <video controls{$this->renderAttributes()}>
                    <source src="{$this->getSrc()}" type="video/mp4" />
                </video>
            </div>
            EOT;
        }

        if ($this->getType() === 'embed') {
            return <<<EOT
            <div class="dd-video-container">
               {$this->getSrc()}
            </div>
            EOT;
        }
    }
}
