<?php

it('can render a heading node', function () {

    $node = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 1,
    ];

    $heading = new \SchoolSpider\SpiderEditor\Nodes\Heading($node);

    expect($heading->render())->toEqual('<h1>This is a heading</h1>');
});

it('can render a heading node with attributes', function () {

    $node = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 2,
        'attributes' => [
            'class' => 'my-heading',
            'id' => 'my-heading-id',
        ],
    ];

    $heading = new \SchoolSpider\SpiderEditor\Nodes\Heading($node);

    expect($heading->render())->toEqual('<h2 id="my-heading-id" class="my-heading">This is a heading</h2>');
});

it('can render a heading node with attributes with falsy values', function () {

    $node = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 2,
        'attributes' => [
            'class' => 'my-heading',
            'id' => 'my-heading-id',
            'data-foo' => false,
        ],
    ];


    $heading = new \SchoolSpider\SpiderEditor\Nodes\Heading($node);

    $headingEl = $this->document($heading->render())->getElementsByTagName('h2')->item(0);

    expect($headingEl->getAttribute('id'))->toEqual('my-heading-id');
    expect($headingEl->getAttribute('class'))->toEqual('my-heading');
    expect($headingEl->getAttribute('data-foo'))->toEqual('');

    expect($heading->render())->toEqual('<h2 id="my-heading-id" data-foo="" class="my-heading">This is a heading</h2>');

});
