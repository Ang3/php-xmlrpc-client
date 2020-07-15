<?php

namespace Ang3\Component\XmlRpc\Exception;

class RemoteException extends RequestException
{
    public function __construct(int $faultCode, string $faultString)
    {
        parent::__construct($faultString, $faultCode);
    }
}
