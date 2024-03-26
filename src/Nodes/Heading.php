<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Heading extends Node
{
    protected $type = 'heading';

    protected $level = 1;

    public function __construct(array $node = [])
    {
        parent::__construct($node);
        $this->level = $node['level'] ?? 1;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function renderContent()
    {
        return $this->node['content'];
    }

    public function render()
    {
        return "<h{$this->level}{$this->renderAttributes()}>{$this->renderContent()}</h{$this->level}>";
    }
}
