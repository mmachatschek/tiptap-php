<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'p',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['p', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
