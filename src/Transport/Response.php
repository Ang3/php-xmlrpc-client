<?php

namespace Ang3\Component\XmlRpc\Transport;

class Response
{
    /**
     * @var mixed|null
     */
    private $headers;

    /**
     * @var string|null
     */
    private $contents;

    /**
     * @param mixed|null $headers
     */
    public function __construct(string $contents = null, $headers = null)
    {
        $this->contents = $contents;
        $this->headers = $headers;
    }

    /**
     * @return mixed|null
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string|null
     */
    public function getContents()
    {
        return $this->contents;
    }
}
