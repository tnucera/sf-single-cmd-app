<?php declare(strict_types = 1);

namespace Cmd\Exception;

class CommandException extends \RuntimeException
{
    /**
     * Rend le message obligatoire
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(string $message, int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
