<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Slideshow extends Node
{
    protected $type = 'slideshow';

    public function renderChildren()
    {
        $html = [];

        foreach ($this->node['content'] as $child) {
            $html[] = (new Slide($child))->addClass('item not-prose')->addAttribute('data-lightbox', $this->node['id'])->render();
        }

        return implode("\n", $html);
    }

    public function render()
    {
        return <<<EOT
            <div{$this->renderAttributes()}>
                {$this->renderChildren()}
            </div>
        EOT;
    }
}
