TmsMergeFieldBundle
===================

Symfony2's TMS Merge Tag Bundle.


Installation
------------

Add dependencies in your `composer.json` file:
```json
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/Tessi-Tms/TmsMergeTagBundle.git"
    }
],
"require": {
    ...,
    "tms/merge-tag": "dev-master"
}
```

Install these new dependencies of your application:
```sh
$ php composer.phar update
```

Enable bundles in your application kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tms\Bundle\MergeTagBundle\TmsMergeTagBundle(),
    );
}
```


Documentation
-------------

[Read the Documentation](Resources/doc/index.md)


Tests
-----

Install bundle dependencies:
```sh
$ php composer.phar update
```

To execute unit tests:
```sh
$ phpunit --coverage-text
```
