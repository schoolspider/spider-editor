<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Table extends Node
{
    protected $type = 'table';

    public function renderContent()
    {
        return $this->node['content'];
    }

    public function render()
    {
        return <<<EOT
        <div class="dd-table-wrapper">
            {$this->renderContent()}
        </div>
        EOT;
    }
}
