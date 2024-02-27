<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class File extends Node
{
    protected $type = 'file';

    public function renderContent()
    {
        return $this->node['name'];
    }

    public function render()
    {
        return <<<EOT
            <div class="dd-file">
                <a{$this->renderAttributes()} download>{$this->renderContent()}</a>
            </div>
        EOT;
    }
}
