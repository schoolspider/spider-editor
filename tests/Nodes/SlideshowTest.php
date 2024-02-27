<?php

it('can render a slideshow node', function () {

    $node = [
        'type' => 'slideshow',
        'id' => 'my-slideshow',
        'content' => [
            [
                'src' => 'https://example.com/image.png',
                'thumbnail' => 'https://example.com/thumbnail.png',
                'name' => 'Example image',
            ],
        ],
        'attributes' => [],
    ];

    $slideshow = new \SchoolSpider\SpiderEditor\Nodes\Slideshow($node);
    $html = $this->flattenHTML($slideshow->render());

    expect($html)->toEqual('<div><div class="item not-prose"><a href="https://example.com/image.png" class="dd-slideshow-image-link" data-lightbox="my-slideshow"><img src="https://example.com/thumbnail.png" alt="Example image" /></a></div></div>');

});
