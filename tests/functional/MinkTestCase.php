<?php

use Silex\WebTestCase;

use Symfony\Component\HttpKernel\Client;

use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\Mink\Driver;

abstract class MinkTestCase extends \PHPUnit_Framework_TestCase
{
    private static $mink;

    public static function setUpBeforeClass()
    {
        if (null === self::$mink) {
            $app = new Acme\Application;
            $app['debug'] = true;
            $app['session.test'] = true;
            $app['exception_handler']->disable();

            self::$mink = new Mink(array(
                'silex'    => new Session(new Driver\BrowserKitDriver(new Client($app))),
                'selenium' => new Session(new Driver\Selenium2Driver),
            ));

            self::$mink->setDefaultSessionName('silex');
        }
    }

    protected function teardown()
    {
        self::$mink->resetSessions();
    }

    protected function getMink()
    {
        return self::$mink;
    }

    protected function getSession($name = null)
    {
        return $this->getMink()->getSession($name);
    }

    protected function getPage($name = null)
    {
        return $this->getSession($name)->getPage();
    }

    protected function assertSession($name = null)
    {
        return $this->getMink()->assertSession($name);
    }
}
