<?php declare(strict_types=1);

namespace Tiptap;

use Exception;
use Tiptap\Core\Mark;
use Tiptap\Core\Node;

/**
 * @property array $marks
 * @property array $nodes
 */
class Schema
{
    public static array $extensions = [];

    public static function from(array $extensions = []): self
    {
        static::$extensions = self::loadExtensions($extensions);

        return new self;
    }

    private static function loadExtensions(array $extensions = []): array
    {
        foreach ($extensions as $extension) {
            if (method_exists($extension, 'addExtensions') && count($extension->addExtensions())) {
                $extensions = array_merge(
                    $extensions,
                    self::loadExtensions($extension->addExtensions()),
                );
            }
        }

        return $extensions;
    }

    public static function apply($document): array
    {
        if (! is_array($document['content'])) {
            return $document;
        }

        $document['content'] = array_map(function ($node) {
            foreach (self::$extensions as $extension) {
                if (! isset($node['type']) || $node['type'] !== $extension::$name) {
                    continue;
                }

                if (property_exists($extension, 'marks')) {
                    if ($extension::$marks === '') {
                        $node = self::filterMarks($node);

                        unset($node['marks']);
                    }

                    // TODO: Support for multiple marks is missing
                }

                break;
            }

            return $node;
        }, $document['content']);

        return $document;
    }

    public static function filterMarks(&$node)
    {
        unset($node['marks']);

        if (isset($node['content'])) {
            $node['content'] = array_map(function ($child) {
                return self::filterMarks($child);
            }, $node['content']);
        }

        return $node;
    }

    public function __get($name)
    {
        if ($name === 'nodes') {
            return array_filter(self::$extensions, function ($extension) {
                return is_subclass_of($extension, Node::class);
            });
        }

        if ($name === 'marks') {
            return array_filter(self::$extensions, function ($extension) {
                return is_subclass_of($extension, Mark::class);
            });
        }

        throw new Exception("[Schema] Can’t access `${name}`.");
    }
}
