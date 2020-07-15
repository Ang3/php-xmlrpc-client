<?php

namespace Ang3\Component\XmlRpc\Transport;

use Ang3\Component\XmlRpc\Exception\RequestException;

class TransportException extends RequestException
{
    public static function create(string $url, int $code = 0, \Throwable $previous = null): self
    {
        return new self(sprintf('Cannot access to URL "%s"', $url), $code, $previous);
    }
}
