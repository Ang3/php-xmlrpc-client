<?php

namespace Ang3\Component\XmlRpc;

use Ang3\Component\XmlRpc\Exception\ConfigurationException;
use Ang3\Component\XmlRpc\Exception\RemoteException;
use Ang3\Component\XmlRpc\Exception\RequestException;
use Ang3\Component\XmlRpc\Transport\Stream;
use Ang3\Component\XmlRpc\Transport\TransportInterface;

class Client
{
    /**
     * The url of the rpc server.
     *
     * @var string
     */
    private $url;

    /**
     * The transport used to post requests.
     *
     * @var TransportInterface
     */
    private $transport;

    /**
     * A list of output options, used with the xmlrpc_encode_request method.
     *
     * @var array
     */
    private $outputOptions = [
        'output_type' => 'xml',
        'verbosity' => 'pretty',
        'escaping' => ['markup'],
        'version' => 'xmlrpc',
        'encoding' => 'utf-8',
    ];

    public function __construct(string $url, TransportInterface $transport = null, array $outputOptions = [])
    {
        if (!function_exists('xmlrpc_encode_request')) {
            throw ConfigurationException::missingPhpXmlRpcExtension();
        }

        $this->url = $url;
        $this->transport = $transport ?: new Stream();
        $this->outputOptions = array_merge($this->outputOptions, $outputOptions);
    }

    /**
     * @throws RequestException when the request failed
     *
     * @return mixed
     */
    public function call(string $name, array $args = [])
    {
        $request = xmlrpc_encode_request($name, $args, $this->outputOptions);
        $response = $this->transport->post($this->url, $request);

        $contents = $response->getContents();
        if (null === $contents) {
            return null;
        }

        $result = xmlrpc_decode($contents, 'utf-8');

        if (isset($result) && is_array($result) && xmlrpc_is_fault($result)) {
            throw new RemoteException($result['faultCode'], $result['faultString']);
        }

        return $result;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTransport(): TransportInterface
    {
        return $this->transport;
    }

    public function setTransport(TransportInterface $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getOutputOptions(): array
    {
        return $this->outputOptions;
    }

    public function setOutputOptions(array $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }
}
