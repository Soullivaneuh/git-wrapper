<?php

namespace GitWrapper\Event;

/**
 * Event handler that streams real-time output from Git commands to STDOUT and
 * STDERR.
 */
class GitOutputStreamListener implements GitOutputListenerInterface
{
    public function handleOutput(GitOutputEvent $event)
    {
        // Prefixed with backslashes for HHVM
        // @see https://github.com/facebook/hhvm/issues/2544#issuecomment-52751506
        $handler = $event->isError() ? \STDERR : \STDOUT;
        fputs($handler, $event->getBuffer());
    }
}
