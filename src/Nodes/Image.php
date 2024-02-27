<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Image extends Node
{
    protected $type = 'image';

    public function getSrc()
    {
        return $this->node['content']['src'] ?? '';
    }

    public function getName()
    {
        return $this->node['content']['name'] ?? '';
    }

    public function render()
    {
        return <<<EOT
            <div>
                <img src="{$this->getSrc()}" alt="{$this->getName()}"{$this->renderAttributes()} />
            </div>
        EOT;
    }
}
