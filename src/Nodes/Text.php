<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Text extends Node
{
    public static $name = 'text';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => '#text',
            ],
        ];
    }
}
