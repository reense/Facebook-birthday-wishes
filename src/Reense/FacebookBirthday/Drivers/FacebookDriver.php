<?php

namespace Reense\FacebookBirthday\Drivers;


use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;

class FacebookDriver extends WebDriver
{
    protected $facebookLoginUrl =  'https://www.facebook.com/';
    protected $birthdaysUrl     =  'https://www.facebook.com/birthdays';

    protected $messages = [
        'Gefeliciteerd! 🙂',
        'Fijne verjaardag!',
        'Gefeliciteerd.',
        'Happy Birthday!'
    ];

    protected $loginElements = [
        'email'     => '#email',
        'password'  => '#pass'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->driver->get($this->facebookLoginUrl);
    }

    public function loginWithCredentials($email, $password) {
        try {
            $element = $this->driver->findElement(WebDriverBy::cssSelector('#login_form'));

            $emailElement = $element->findElement(WebDriverBy::cssSelector($this->loginElements['email']));
            $passwordElement = $element->findElement(WebDriverBy::cssSelector($this->loginElements['password']));

            $emailElement->sendKeys($email);
            $passwordElement->sendKeys($password);

            $element->findElement(WebDriverBy::cssSelector('#loginbutton'))->click();
        } catch(\Exception $e) {
            echo "Fuck". $e->getMessage();
            return true;
        }

        return true;
    }

    public function navigateToBirthdays() {
        $this->driver->get($this->birthdaysUrl);
    }

    public function congratulateAll() {
        $elements = $this->driver->findElements(WebDriverBy::cssSelector(".fbCalendarHappyBirthdayer"));

        foreach($elements as $element) {
            $bd = $element->findElements(WebDriverBy::cssSelector('textarea'));
            foreach ($bd as $user) {
                $user->sendKeys($this->messages[array_rand($this->messages)]);
                $user->sendKeys(WebDriverKeys::RETURN_KEY);

            }
        }
    }

}