<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\DOMSerialiser;
use SchoolSpider\SpiderEditor\Core\Node;

class Layout extends Node
{
    protected $type = 'layout';

    public function renderChildren()
    {
        $html = [];

        foreach ($this->node['children'] as $child) {
            $html[] = (new DOMSerialiser([$child]))->process();
        }

        return implode("\n", $html);
    }

    public function getConfig()
    {
        return $this->node['config'];
    }

    public function render()
    {
        $config = $this->getConfig();

        $cols = $config['cols'];
        $widths = $config['layout']['widths'];

        if ($cols === 2) {

            if ($widths[0] === 50) {
                $this->addStyle('--dd-grid-columns', 'repeat(2, minmax(0, 1fr))');
            } else {

                $this->addStyle('--dd-grid-columns', implode('fr ', $widths).'fr');
            }

        } else {
            $this->addStyle('--dd-grid-columns', 'repeat('.$cols.', minmax(0, 1fr))');
        }

        if (isset($config['gap'])) {
            $this->addStyle('--dd-grid-gap', $config['gap']);
        }

        return <<<EOT
            <div{$this->renderAttributes()}>
                {$this->renderChildren()}
            </div>
        EOT;
    }
}
