<?php

use Tiptap\Editor;

test('b gets rendered correctly', function () {
    $html = '<p><b>Example</b> Text</p>';

    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor)->setContent($html)->getDocument());
});

test('strong gets rendered correctly', function () {
    $html = '<p><strong>Example</strong> Text</p>';

    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor)->setContent($html)->getDocument());
});

test('b with font weight normal is ignored', function () {
    $html = '<p><b style="font-weight: normal;">Example</b> Text</p>';

    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor)->setContent($html)->getDocument());
});

test('span with font weight bold is parsed', function () {
    $html = '<p><span style="font-weight: bold;">Example</span> Text</p>';

    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor)->setContent($html)->getDocument());
});
