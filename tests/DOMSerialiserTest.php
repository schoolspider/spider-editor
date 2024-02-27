<?php

use SchoolSpider\SpiderEditor\Core\DOMSerialiser;

it('can render a heading node', function () {

    $h1 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 1,
    ];

    $h2 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 2,
    ];

    $h3 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 3,
    ];

    $h4 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 4,
    ];

    $h5 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 5,
    ];

    $h6 = [
        'type' => 'heading',
        'content' => 'This is a heading',
        'level' => 6,
    ];

    $h1 = (new DOMSerialiser([$h1]))->process();
    expect($h1)->toEqual('<h1>This is a heading</h1>');

    $h2 = (new DOMSerialiser([$h2]))->process();
    expect($h2)->toEqual('<h2>This is a heading</h2>');

    $h3 = (new DOMSerialiser([$h3]))->process();
    expect($h3)->toEqual('<h3>This is a heading</h3>');

    $h4 = (new DOMSerialiser([$h4]))->process();
    expect($h4)->toEqual('<h4>This is a heading</h4>');

    $h5 = (new DOMSerialiser([$h5]))->process();
    expect($h5)->toEqual('<h5>This is a heading</h5>');

    $h6 = (new DOMSerialiser([$h6]))->process();
    expect($h6)->toEqual('<h6>This is a heading</h6>');

});

it('can render a content node', function () {
    $node = [
        'type' => 'content',
        'content' => '<p>This is a paragraph</p>',
        'attributes' => [],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    expect($html)->toEqual('<p>This is a paragraph</p>');
});

it('can render an image node', function () {

    $node = [
        'type' => 'image',
        'content' => [
            'src' => 'https://example.com/image.png',
            'name' => 'Example image',
        ],
        'attributes' => [],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    $html = $this->flattenHTML($html);

    expect($html)->toEqual('<div><img src="https://example.com/image.png" alt="Example image" class="dd-image" /></div>');
});

it('can render a 2 column layout node', function () {

    $node = [
        'type' => 'layout',
        'config' => [
            'cols' => 2,
            'layout' => [
                'id' => '50-50',
                'widths' => [50, 50],
            ],
        ],

        'children' => [
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],

            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],
        ],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    $html = $this->flattenHTML($html);

    expect($html)->toEqual('<div class="dd-layout" style="--dd-grid-columns: repeat(2, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
});

it('can render a 3 column layout node', function () {

    $node = [
        'type' => 'layout',
        'config' => [
            'cols' => 3,
            'layout' => [
                'id' => '33-33-33',
                'widths' => [33, 33, 33],
            ],
        ],

        'children' => [
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],

            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],
        ],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    $html = $this->flattenHTML($html);

    expect($html)->toEqual('<div class="dd-layout" style="--dd-grid-columns: repeat(3, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
});

it('can render a 4 column layout node', function () {

    $node = [
        'type' => 'layout',
        'config' => [
            'cols' => 4,
            'layout' => [
                'id' => '25-25-25-25',
                'widths' => [25, 25, 25, 25],
            ],
        ],

        'children' => [
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],

            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],
            [
                'type' => 'column',
                'children' => [
                    [
                        'type' => 'content',
                        'content' => '<p>This is a paragraph</p>',
                        'attributes' => [],
                    ],
                ],
            ],

        ],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    $html = $this->flattenHTML($html);

    $el = $this->document($html)->getElementsByTagName('div')->item(0);

    expect($el->getAttribute('style'))->toEqual('--dd-grid-columns: repeat(4, minmax(0, 1fr))');
    expect($el->getAttribute('class'))->toEqual('dd-layout');

    expect($html)->toEqual('<div class="dd-layout" style="--dd-grid-columns: repeat(4, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
});

it('can render a slideshow with 2 images', function () {

    $node = [
        'id' => 'my-slideshow',
        'type' => 'slideshow',
        'content' => [
            [
                'id' => 'my-image-1',
                'src' => 'https://example.com/image.png',
                'thumbnail' => 'https://example.com/thumbnail.png',
                'name' => 'Example image',
            ],
            [
                'id' => 'my-image-2',
                'src' => 'https://example.com/image.png',
                'thumbnail' => 'https://example.com/thumbnail.png',
                'name' => 'Example image',
            ],
        ],
    ];

    $html = (new DOMSerialiser([$node]))->process();

    $html = $this->flattenHTML($html);

    $el = $this->document($html)->getElementsByTagName('div')->item(0);

    expect($el->getAttribute('class'))->toEqual('dd-slideshow');

    expect(count($el->getElementsByTagName('a')))->toEqual(2);
    expect(count($el->getElementsByTagName('img')))->toEqual(2);

    $anchors = $el->getElementsByTagName('a');

    expect($anchors->item(0)->getAttribute('href'))->toEqual('https://example.com/image.png');
    expect($anchors->item(0)->getAttribute('data-lightbox'))->toEqual('my-slideshow');

    expect($anchors->item(1)->getAttribute('href'))->toEqual('https://example.com/image.png');
    expect($anchors->item(1)->getAttribute('data-lightbox'))->toEqual('my-slideshow');

});
