<?php

namespace Tiptap\JSONOutput\Nodes;

class CodeBlock extends Node
{
    public function parseHTML($DOMNode)
    {
        return
            $DOMNode->nodeName === 'code' &&
            $DOMNode->parentNode->nodeName === 'pre';
    }

    public function data($DOMNode)
    {
        $language = preg_replace("/^language-/", "", $DOMNode->getAttribute('class'));

        if ($language) {
            return [
                'type' => 'code_block',
                'attrs' => [
                    'language' => $language,
                ],
            ];
        }

        return [
            'type' => 'code_block',
        ];
    }
}
