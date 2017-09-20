<?php
namespace LampOfGod\Kahlan\Jit\Patcher;

/**
 * Patcher for functions isolation from old legacy code.
 * It removes everything except "use" statements and functions.
 */
class Isolator
{
    /**
     * The JIT find file patcher.
     *
     * @param object $loader   The autoloader instance.
     * @param string $class    The fully-namespaced class name.
     * @param string $file     The corresponding found file path.
     *
     * @return string         The patched file path.
     */
    public function findFile($loader, $class, $file)
    {
        return $file;
    }

    /**
     * The JIT patchable checker.
     *
     * @param string $class   The fully-namespaced class name to check.
     *                        Not really used. For interface implementation
     *                        only.
     *
     * @return boolean
     */
    public function patchable($class)
    {
        return true;
    }

    /**
     * The JIT patcher.
     *
     * @param object $node   The node instance to patch.
     * @param string $path   The file path of the source code. Not really used.
     *                       For interface implementation only.
     *
     * @return object       The patched node.
     */
    public function process($node, $path = null)
    {
        foreach ($node->tree as $subNode) {
            if ($subNode->processable
                && !in_array($subNode->type, ['open', 'use', 'function'])
            ) {
                $subNode->body = '';
                $subNode->close = '';
                $subNode->tree = [];
            }
        }
        return $node;
    }
}
