<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Image extends Node
{
    public static $name = 'image';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'img[src]',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'src' => [],
            'alt' => [],
            'title' => [],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['img', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
