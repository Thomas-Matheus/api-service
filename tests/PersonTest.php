<?php

namespace App\Tests;

use App\Domain\Entity\Person;
use App\Domain\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PersonTest.
 */
class PersonTest extends WebTestCase
{
    public function testName()
    {
        $person = new Person(1, 'Joseph');

        $this->assertEquals('Joseph', $person->getName());
    }

    public function testPhonesPerson()
    {
        $person = new Person(1, 'Paul');
        $firstPhone = new Phone('8888-8888');
        $secondPhone = new Phone('8888-9999');
        $person->addPhones($firstPhone);
        $person->addPhones($secondPhone);

        $this->assertCount(2, $person->getPhones());
    }
}
