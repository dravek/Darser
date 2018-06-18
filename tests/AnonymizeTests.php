<?php

declare(strict_types=1);
namespace Darser\Tests;

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Darser\Helpers\Anonymize;

final class AnonymizeTest extends TestCase
{

    /**
     * Test anonymize Email
     *
     * @return void
     */
    public function testAnonymizeEmail(): void
    {
        $anonymize = new Anonymize();
        $email = 'david@test.com';
        $this->assertEquals(
            '*****@test.com',
            $anonymize->anonymizeEmail($email)
        );
    }

    /**
     * Test Anonymize a hort email with only 2 characters
     *
     * @return void
     */
    public function testAnonymizeEmailWithOnly2Chars(): void
    {
        $anonymize = new Anonymize();
        $email = 'da@es.com';
        $this->assertEquals(
            '**@es.com',
            $anonymize->anonymizeEmail($email)
        );
    }

    /**
     * Testing anonymize long email
     *
     * @return void
     */
    public function testAnonymizeEmailWithLongStrings(): void
    {
        $anonymize = new Anonymize();
        $email = 'thisisalong_email@gmail.com';
        $this->assertEquals(
            'thisisalo********@gmail.com',
            $anonymize->anonymizeEmail($email)
        );
    }

   
}