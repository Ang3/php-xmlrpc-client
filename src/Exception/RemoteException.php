<?php

namespace Ang3\Component\XmlRpc\Exception;

class RemoteException extends RequestException
{
    public static function create(int $faultCode, string $faultString): self
    {
        return new self($faultString, $faultCode);
    }
}
