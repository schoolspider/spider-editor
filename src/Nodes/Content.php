<?php


namespace SchoolSpider\SpiderEditor\Nodes;

use SchoolSpider\SpiderEditor\Core\Node;

class Content extends Node
{
    protected $type = 'content';


    public function render()
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($this->node['content']);

        $images = $dom->getElementsByTagName('img');


        foreach ($images as $image) {
            /** @var \DOMElement $image */
            $styles = collect(explode(';', $image->getAttribute('style')))->mapWithKeys(function ($style) {
                [$key, $value] = explode(':', $style);
                return [trim($key) => trim($value)];
            });

            if($styles->has('margin-right')){
                $styles->put('--margin-right', $styles->get('margin-right'));
                $styles->pull('margin-right');
            }

            if($styles->has('margin-left')){
                $styles->put('--margin-left', $styles->get('margin-left'));
                $styles->pull('margin-left');
            }

            $styles->put('--width', $image->getAttribute('width') . 'px');
            $styles->put('--height', $image->getAttribute('height') . 'px');

            $styles->pull('aspect-ratio');

            $image->setAttribute('style', $styles->map(function ($value, $key) {
                return "$key: $value";
            })->implode('; '));


            $image->setAttribute('class', 'dd-responsive-image');
        }

        return $dom->saveHTML();
    }
}
