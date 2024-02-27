<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class CarouselItem extends Node
{
    protected $type = 'carousel_item';

    public function getSrc()
    {
        return $this->node['src'];
    }

    public function getName()
    {
        return $this->node['name'];
    }

    public function render()
    {
        return <<<EOT
            <div{$this->renderAttributes()}>
                <img src="{$this->getSrc()}" alt="{$this->getName()}" />
            </div>
        EOT;
    }
}
