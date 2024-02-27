<?php

namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Audio extends Node
{
    protected $type = 'audio';

    public function getSrc()
    {
        return $this->node['content']['src'] ?? '';
    }

    public function getName()
    {
        return $this->node['content']['name'] ?? '';
    }

    public function renderChildren()
    {
        $html = [];

        foreach ($this->node['content'] as $child) {
            $html[] = <<<EOT
                    <media-controller audio>
                        <audio
                            slot="media"
                            src="{$child['src']}"
                        ></audio>
                        <media-control-bar>
                            <media-play-button></media-play-button>
                            <media-text-display>{$child['name']}</media-text-display>
                            <media-time-display showduration></media-time-display>
                            <media-time-range></media-time-range>
                            <media-mute-button></media-mute-button>
                            <media-volume-range></media-volume-range>
                        </media-control-bar>
                    </media-controller>
            EOT;
        }

        return implode("\n", $html);

    }

    public function render()
    {
        return <<<EOT
            <div class="dd-audio-container">
                {$this->renderChildren()}
            </div>
        EOT;
    }
}
