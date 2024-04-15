<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\DOMSerialiser;
use SchoolSpider\SpiderEditor\Core\Node;

class Column extends Node
{
    protected $type = 'column';

    public function renderChildren()
    {
        $html = [];

        foreach ($this->node['children'] as $child) {
            $html[] = (new DOMSerialiser([$child]))->process();
        }

        return implode("\n", $html);
    }

    public function render()
    {
        $this->removeAllStyles();


        return "<div{$this->renderAttributes()}>{$this->renderChildren()}</div>";
    }
}
