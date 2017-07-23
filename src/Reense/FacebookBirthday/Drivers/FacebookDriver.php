<?php

namespace Reense\FacebookBirthday\Drivers;


use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class FacebookDriver extends WebDriver
{
    protected $facebookLoginUrl =  'https://www.facebook.com/login.php';
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

    private $output;

    public function __construct(OutputInterface $output)
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
            $this->output->writeln("<error> Could not login. The error message is: {$e->getMessage()}.</error>");
            return false;
        }

        return true;
    }

    public function navigateToBirthdays() {
        $this->driver->get($this->birthdaysUrl);

        
    }

    public function congratulateAll() {
        try {
            /**
             * Get all the elements from that page that contain people
             * having their birthday today
             */
            $peopleToCongratulate = $this->driver->findElements(WebDriverBy::cssSelector(".fbCalendarHappyBirthdayer"));

            foreach ($peopleToCongratulate as $personToCongratulate) {
                $birthdayTextElements = $personToCongratulate->findElements(WebDriverBy::cssSelector('textarea'));
                foreach ($birthdayTextElements as $birthdayTextElement) {
                    /**
                     * Set a custom message, so that it looks more natural.
                     */
                    $birthdayTextElement->sendKeys($this->messages[array_rand($this->messages)]);
                    /**
                     * Hit enter in the textbox, which will trigger a form submit.
                     */
                    $birthdayTextElement->sendKeys(WebDriverKeys::RETURN_KEY);

                }
            }
        } catch(\Exception $e) {
            $this->output->writeln("<error> Could not congratulate people. The error message is: {$e->getMessage()}.</error>");
            return false;
        }
    }

}