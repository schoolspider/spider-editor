<?php


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

    $html = (new \SchoolSpider\SpiderEditor\Nodes\Layout($node))->render();

    $html = $this->flattenHTML($html);

    expect($html)->toEqual('<div style="--dd-grid-columns: repeat(2, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
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

    $html = (new \SchoolSpider\SpiderEditor\Nodes\Layout($node))->render();

    $html = $this->flattenHTML($html);

    expect($html)->toEqual('<div style="--dd-grid-columns: repeat(3, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
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

    $html = new \SchoolSpider\SpiderEditor\Nodes\Layout($node);
    $html = $this->flattenHTML($html->render());


    expect($html)->toEqual('<div style="--dd-grid-columns: repeat(4, minmax(0, 1fr))"><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div><div class="dd-column"><p>This is a paragraph</p></div></div>');
});
