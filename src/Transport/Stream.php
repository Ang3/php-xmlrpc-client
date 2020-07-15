<?php

namespace Ang3\Component\XmlRpc\Transport;

class Stream implements TransportInterface
{
    /**
     * @var array
     */
    private $defaultOptions;

    public function __construct(array $defaultOptions = [])
    {
        $this->defaultOptions = $defaultOptions;
    }

    public function post(string $url, string $xmlRequest): Response
    {
        $options = array_merge_recursive(
            $this->defaultOptions,
            [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: text/xml',
                    'content' => $xmlRequest,
                ],
            ]
        );

        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        if (false === $result) {
            throw TransportException::create($url);
        }

        return new Response($result);
    }
}
