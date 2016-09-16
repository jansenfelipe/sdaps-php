# SDAPS for PHP
[![Latest Stable Version](https://poser.pugx.org/jansenfelipe/sdaps-php/v/stable.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![Total Downloads](https://poser.pugx.org/jansenfelipe/sdaps-php/downloads.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![Latest Unstable Version](https://poser.pugx.org/jansenfelipe/sdaps-php/v/unstable.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php) [![License](https://poser.pugx.org/jansenfelipe/sdaps-php/license.svg)](https://packagist.org/packages/jansenfelipe/sdaps-php)

Integration Sdaps for PHP

### Quick start

Install SDAPS

    See http://sdaps.org/

In the require key of composer.json file add the following

    "jansenfelipe/sdaps-php": "1.0.*@dev"

Execute

    $ composer update


Add autoload.php

    require_once 'vendor/autoload.php';  

Call

```php
<?php

use JansenFelipe\SdapsPHP\SdapsPHP;

$pathProject = '/path/you/want/to/create/the/project/sdaps';

if(SdapsPHP::createProject($pathProject))
{
    SdapsPHP::add($pathProject, '/images/image01.tiff');
    SdapsPHP::recognize($pathProject);
    
    $pathCSV = SdapsPHP::recognize($pathProject);
    
    //handle .csv
}
```

See
    https://github.com/sdaps/sdaps
