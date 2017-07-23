<?php


namespace Reense\FacebookBirthday\Drivers;


use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class WebDriver
{
    protected $driver;

    public function __construct()
    {
        $this->driver = $this->getDriver();
    }

    public function getDriver()
    {
        $host = 'http://localhost:4444/wd/hub';
        return RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }
}