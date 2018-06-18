<?php

declare(strict_types=1);
namespace Darser\Tests;

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Darser\Darser;

final class DarserTest extends TestCase
{

    /**
     * Testing to validate extensions
     *
     * @return void
     */
    public function testValidateExtensions(): void
    {
        $darser = new Darser('csv','xml');

        $this->assertTrue($darser->validateFileTypes('CSV','XML'));
        
    }

    
}