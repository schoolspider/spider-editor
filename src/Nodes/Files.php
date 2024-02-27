<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Files extends Node
{
    protected $type = 'files';

    public function renderChildren()
    {
        $html = [];

        foreach ($this->node['content'] as $file) {
            $html[] = (new File($file))->render();
        }

        return implode($html);
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
