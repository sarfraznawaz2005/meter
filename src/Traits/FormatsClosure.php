<?php

namespace Sarfraznawaz2005\Meter\Traits;

use Closure;
use ReflectionFunction;

trait FormatsClosure
{
    /**
     * Format a closure-based listener.
     *
     * @param  \Closure  $listener
     * @return string
     *
     * @throws \ReflectionException
     */
    protected function formatClosureListener(Closure $listener): string
    {
        $listener = new ReflectionFunction($listener);

        return sprintf('Closure at %s[%s:%s]',
            $listener->getFileName(),
            $listener->getStartLine(),
            $listener->getEndLine()
        );
    }
}
