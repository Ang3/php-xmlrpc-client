PHP XML-RPC client
==================

[![Build Status](https://travis-ci.org/Ang3/php-xmlrpc-client.svg?branch=master)](https://travis-ci.org/Ang3/php-xmlrpc-client) 
[![Latest Stable Version](https://poser.pugx.org/ang3/php-xmlrpc-client/v/stable)](https://packagist.org/packages/ang3/php-xmlrpc-client) 
[![Latest Unstable Version](https://poser.pugx.org/ang3/php-xmlrpc-client/v/unstable)](https://packagist.org/packages/ang3/php-xmlrpc-client) 
[![Total Downloads](https://poser.pugx.org/ang3/php-xmlrpc-client/downloads)](https://packagist.org/packages/ang3/php-xmlrpc-client)

PHP XML-RPC **client only** inspired from package 
[DarkaOnLine/Ripcord](https://packagist.org/packages/darkaonline/ripcord).
The code was rewritted so as to isolate the XML-RPC client and fix code at the same time.

Requirements
============

The PHP extension ```php-xmlrpc``` must be enabled.

Installation
============

Open a command console, enter your project directory and execute the
following command to download the latest stable version of the client:

```console
$ composer require ang3/php-xmlrpc-client
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Usage
=====

Create your client by calling the constructor with the URL of a XML-RPC server. 
Then, call the desired method with optional arguments:

```php
require_once 'vendor/autoload.php';

use Ang3\Component\XmlRpc\Client;

// Create the client
$client = new Client('<xmlrpc_server_url>');

// Call a method and get result
$result = $client->call('method_name', $args = []);
```

> - A ```Ang3\Component\XmlRpc\Exception\TransportException``` when the request to the server failed.
> - A ```Ang3\Component\XmlRpc\Exception\RemoteException``` is thrown if the XML-RPC server returns an error.
> - Both of previous exceptions extend exception ```Ang3\Component\XmlRpc\Exception\RequestException```

That's it!