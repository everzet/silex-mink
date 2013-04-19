Functional testing in Silex with Mink
=====================================

Simple project created as an introduction to standalone [Mink](http://mink.behat.org/).

It is based on the [Silex micro-framework](http://silex.sensiolabs.org/), uses
[Twig](http://twig.sensiolabs.org/) templates and [Symfony](http://symfony.com/)'s
form component.

Installation
------------

Download [the composer](http://getcomposer.org/):

```bash
curl -s http://getcomposer.org/installer | php
```

Install the dependencies:

```bash
php composer.phar install --dev --prefer-dist
```

Running test suite
------------------

All the project's tests can be run with:

```bash
./bin/phpunit
```

Composer created this symbolic link during the installation.

Running in a browser
--------------------

To run all tests in a browser (like Selenium) all you have to
do is:
    
1. Install & run [selenium server](http://docs.seleniumhq.org/download/)
2. Add to `tests/functional/ArticleTest.php`:

    ```php
    ...

    protected function setUp()
    {
        $this->getMink()->setDefaultSessionName('selenium');
    }

    ...
    ```

3. Configure your local web server:

    ```
    <VirtualHost *:80>
        ServerName behat.dev

        DocumentRoot /var/www/behat.dev/web
        DirectoryIndex index.php

        <Directory /var/www/behat.dev/web>
            Options FollowSymLinks
            AllowOverride All
            Order allow,deny
            allow from all
        </Directory>
    </VirtualHost>
    ```

