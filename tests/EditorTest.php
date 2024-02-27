<?php

use SchoolSpider\SpiderEditor\Editor;

it('can parse json content', function () {
    $nodes = [
        [
            'type' => 'content',
            'content' => '<p>This is a paragraph</p>',
            'attributes' => [],
        ],

        [
            'type' => 'heading',
            'content' => 'This is a heading',
            'level' => 2,
            'attributes' => [],
        ],
    ];

    $editor = new Editor();
    $editor->setContent(json_encode($nodes));

    expect($editor->flattenNodes()->toArray())->toEqual($nodes);
});

it('can check for carousel nodes', function () {

    $with_carousel = [
        [
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
                            'type' => 'carousel',
                            'content' => [
                                [
                                    'src' => 'https://picsum.photos/id/237/200/300',
                                    'name' => 'image',
                                ],
                                [
                                    'src' => 'https://picsum.photos/id/237/200/300',
                                    'name' => 'image',
                                ],
                            ],
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
        ],
    ];

    $no_carousel = [
        [
            'type' => 'content',
            'content' => '<p>This is a paragraph</p>',
            'attributes' => [],
        ],
    ];

    $editor_with_carousel = (new Editor())->setContent($with_carousel);
    $editor_without_carousel = (new Editor())->setContent($no_carousel);

    expect($editor_with_carousel->hasCarousel())->toBeTrue();
    expect($editor_without_carousel->hasCarousel())->toBeFalse();

});

it('can check for slideshow nodes', function () {

    $with_slideshow = [
        [
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
                            'type' => 'slideshow',
                            'content' => [
                                [
                                    'src' => 'https://picsum.photos/id/237/200/300',
                                    'name' => 'image',
                                ],
                                [
                                    'src' => 'https://picsum.photos/id/237/200/300',
                                    'name' => 'image',
                                ],
                            ],
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
        ],
    ];

    $no_slideshow = [
        [
            'type' => 'content',
            'content' => '<p>This is a paragraph</p>',
            'attributes' => [],
        ],
    ];

    $editor_with_slideshow = (new Editor())->setContent($with_slideshow);
    $editor_without_slideshow = (new Editor())->setContent($no_slideshow);

    expect($editor_with_slideshow->hasSlideshow())->toBeTrue();
    expect($editor_without_slideshow->hasSlideshow())->toBeFalse();
});

it('can check for audio nodes', function () {

    $with_audio = [
        [
            'type' => 'audio',
            'content' => [
                'src' => 'https://example.com/audio.mp3',
                'name' => 'Example audio',
                'id' => 'my-audio',
            ],
            'attributes' => [],
        ],
    ];

    $no_audio = [
        [
            'type' => 'content',
            'content' => '<p>This is a paragraph</p>',
            'attributes' => [],
        ],
    ];

    $editor_with_audio = (new Editor())->setContent($with_audio);
    $editor_without_audio = (new Editor())->setContent($no_audio);

    expect($editor_with_audio->hasAudio())->toBeTrue();
    expect($editor_without_audio->hasAudio())->toBeFalse();

});
