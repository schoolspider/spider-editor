<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Slide extends Node
{
    protected $type = 'slide';

    public function getSrc()
    {
        return $this->node['src'];
    }

    public function getThumbnail()
    {
        return $this->node['thumbnail'];
    }

    public function getName()
    {
        return $this->node['name'];
    }

    public function render()
    {
        $lightbox = $this->getAttribute('data-lightbox');
        $this->removeAttribute('data-lightbox');

        return <<<EOT
            <div{$this->renderAttributes()}>
                <a href="{$this->getSrc()}" class="dd-slideshow-image-link" data-lightbox="{$lightbox}">
                    <img src="{$this->getThumbnail()}" alt="{$this->getName()}" />
                </a>
            </div>
        EOT;
    }
}
