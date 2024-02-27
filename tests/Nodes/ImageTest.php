<?php

it('can render an image node', function () {

    $node = [
        'type' => 'image',
        'content' => [
            'src' => 'https://example.com/image.png',
            'name' => 'Example image',
        ],
        'attributes' => [],
    ];

    $image = new \SchoolSpider\SpiderEditor\Nodes\Image($node);
    $html = $this->flattenHTML($image->render());

    expect($html)->toEqual('<div><img src="https://example.com/image.png" alt="Example image" /></div>');
});

it('can render an image node with attributes', function () {

    $node = [
        'type' => 'image',
        'content' => [
            'src' => 'https://example.com/image.png',
            'name' => 'Example image',
        ],
        'attributes' => [
            'class' => 'my-image',
            'id' => 'my-image-id',
        ],
    ];

    $image = new \SchoolSpider\SpiderEditor\Nodes\Image($node);
    $html = $this->flattenHTML($image->render());

    expect($html)->toEqual('<div><img src="https://example.com/image.png" alt="Example image" id="my-image-id" class="my-image" /></div>');

});


it('can render an image node with attributes with falsy values', function () {

    $node = [
        'type' => 'image',
        'content' => [
            'src' => 'https://example.com/image.png',
            'name' => 'Example image',
        ],
        'attributes' => [
            'class' => 'my-image',
            'id' => 'my-image-id',
            'data-foo' => false,
        ],
    ];


    $image = new \SchoolSpider\SpiderEditor\Nodes\Image($node);
    $html = $this->flattenHTML($image->render());

    expect($html)->toEqual('<div><img src="https://example.com/image.png" alt="Example image" id="my-image-id" data-foo="" class="my-image" /></div>');

});
