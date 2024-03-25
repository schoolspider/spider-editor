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
        $this->addClass('file');

        return <<<EOT
            <div class="dd-file-container">
                <a{$this->renderAttributes()} download>{$this->renderContent()}</a>
            </div>
        EOT;
    }
}
