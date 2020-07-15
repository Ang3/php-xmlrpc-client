<?php

namespace Ang3\Component\XmlRpc\Transport;

use Ang3\Component\XmlRpc\Exception\TransportException;

interface TransportInterface
{
    /**
     * @throws TransportException when posting failed
     */
    public function post(string $url, string $xmlRequest): Response;
}
