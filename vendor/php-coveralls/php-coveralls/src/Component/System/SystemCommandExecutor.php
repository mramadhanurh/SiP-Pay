<?php

namespace PhpCoveralls\Component\System;

/**
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * @internal
 */
final class SystemCommandExecutor implements SystemCommandExecutorInterface
{
    /**
     * Execute command.
     *
     * @param string $command
     *
     * @return array
     *
     * @throws \RuntimeException
     */
    public function execute($command)
    {
        exec($command, $result, $returnValue);

        if (0 === $returnValue) {
            return $result;
        }

        throw new \RuntimeException(\sprintf('Failed to execute command: %s', $command), $returnValue);
    }
}
