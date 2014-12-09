[![Build Status](https://travis-ci.org/Torreycommerce/cloudflare.svg?branch=master)](https://travis-ci.org/Torreycommerce/cloudflare)
[![Coverage Status](https://img.shields.io/coveralls/Torreycommerce/cloudflare.svg)](https://coveralls.io/r/Torreycommerce/cloudflare?branch=master)
[![Dependency Status](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a/badge.svg?style=flat)](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a)

[![Latest Stable Version](https://poser.pugx.org/Torreycommerce/cloudflare/v/stable.svg)](https://packagist.org/packages/Torreycommerce/cloudflare) [![Total Downloads](https://poser.pugx.org/Torreycommerce/cloudflare/downloads.svg)](https://packagist.org/packages/Torreycommerce/cloudflare) [![Latest Unstable Version](https://poser.pugx.org/Torreycommerce/cloudflare/v/unstable.svg)](https://packagist.org/packages/Torreycommerce/cloudflare) [![License](https://poser.pugx.org/Torreycommerce/cloudflare/license.svg)](https://packagist.org/packages/Torreycommerce/cloudflare)

#Cloudflare API V4 PHP wrapper

A work in progress library for the new Cloudflare API. The documentation for the new API  can be found at http://developers.cloudflare.com/next/.


I have integrated most of the methods available but many features from the current API have not been implemented yet. For now I suggest you use the API wrapper written by [vexxhost](https://github.com/vexxhost) which can befound at https://github.com/vexxhost/CloudFlare-API.


##Installation
Installation should be done via composer, details of how to install composer can be found at https://getcomposer.org/


Add `"Torreycommerce/cloudflare": "dev-master"` to your `composer.json` file

Run `composer update` to install the latest version.

##Usage

In situations where you want to make multiple calls to the API across different services it's easier to create a connection to the api first and then pass that around the other services e.g.

```php
    use Torreycommerce\Cloudflare;

    // Create a connection to the Cloudflare API which you can
    // then pass into other services, e.g. DNS, later on
    $client = new Cloudflare\Api('email@example.com', 'API_KEY');

    // Create a new DNS record
    $dns = new Cloudflare\Dns($client);
    $dns->create('12345678901234567890', 'TXT', '127.0.0.1', 120);
```

If you are just performing a single action then you can connect to the API directly when you instantiate the class e.g.
```php
    use Torreycommerce\Cloudflare;

    // Create a connection to the Cloudflare API which you can
    // then pass into other services, e.g. DNS, later on
    $dns = new Cloudflare\Dns('email@example.com', 'API_KEY');
    $dns->create('12345678901234567890', 'TXT', '127.0.0.1', 120);
```

#License
MIT