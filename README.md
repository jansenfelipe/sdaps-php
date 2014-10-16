# SDAPS for PHP
[![Latest Stable Version](https://poser.pugx.org/jansenfelipe/sdaps-php/v/stable.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![Total Downloads](https://poser.pugx.org/jansenfelipe/sdaps-php/downloads.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![Latest Unstable Version](https://poser.pugx.org/jansenfelipe/sdaps-php/v/unstable.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![License](https://poser.pugx.org/jansenfelipe/sdaps-php/license.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php)

Integration Sdaps for PHP - http://sdaps.org/

### Quick start

In the require key of composer.json file add the following

    "jansenfelipe/sdaps-php": "1.0.*@dev"

Execute

    $ composer update


Add autoload.php

    require_once 'vendor/autoload.php';  

Call

    use JansenFelipe\SdapsPHP\SdapsPHP;
    $boolean = SdapsPHP::createProject('/path/you/want/to/create/the/project/sdaps');
    
See
    https://github.com/sdaps/sdaps
