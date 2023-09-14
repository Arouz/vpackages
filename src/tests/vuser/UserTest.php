<?php

namespace Vittascience\Tests\Vuser;

use PHPUnit\Framework\TestCase;
use Vittascience\TestConstants;
use Vittascience\Entity\Vuser\User;
use Utils\Exceptions\EntityDataIntegrityException;

class UserTest extends TestCase
{
   // Firstname is a string only
   public function testFirstNameIsSet()
   {
      $user = new User();

      $acceptedFirstName = 'aaaa';
      $user->setFirstName($acceptedFirstName); // right argument
      $this->assertEquals($user->getFirstName(), $acceptedFirstName);
      $this->expectException(\TypeError::class);
      $user->setFirstName(TestConstants::TEST_INTEGER); // integer
      $user->setFirstName(true); // boolean
      $user->setFirstName(null); // null
   }
   // Surname is a string only
   public function testSurnameIsSet()
   {
      $user = new User();

      $acceptedFirstName = 'aaaa';

      $user->setSurname($acceptedFirstName); // right argument
      $this->assertEquals($user->getSurname(), $acceptedFirstName);
      $this->expectException(\TypeError::class);
      $user->setSurname(TestConstants::TEST_INTEGER); // integer
      $user->setSurname(true); // boolean
      $user->setSurname(null); // null
   }
   // Password is a string only
   public function testPasswordIsSet()
   {
      $user = new User();
      $user->setPassword(TestConstants::TEST_STRING); // right argument
      $this->assertEquals($user->getPassword(), TestConstants::TEST_STRING);
      $this->expectException(\TypeError::class);
      $user->setPassword(TestConstants::TEST_INTEGER); // integer
      $user->setPassword(true); // boolean
      $user->setPassword(null); // null
   }

   // Update date is datetime or null only
   public function testDateIsSet()
   {
      $user = new User();
      $date = new \DateTime('now');
      $user->setInsertDate($date);
      $this->assertEquals($user->getInsertDate(), $date);
      $user->setUpdateDate(null); // can be null
      $this->assertEquals($user->getUpdateDate(), null);
      $this->expectException(\TypeError::class);
      $user->setUpdateDate(TestConstants::TEST_INTEGER); // should not be integer
      $user->setUpdateDate(TestConstants::TEST_STRING); // should not be a string
   }
}
