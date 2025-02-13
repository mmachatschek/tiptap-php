<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class StrikeTest extends TestCase
{
    /** @test */
    public function strike_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'strike',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<strike>Example Text</strike>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
