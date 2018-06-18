<?php

declare(strict_types=1);
namespace Darser\Tests;

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Darser\Input\CSVParser;

final class CSVParserTest extends TestCase
{

    /**
     * Testing to check if contains emails and anonymize it
     */
    public function testCheckIfHasEmailAndAnonymizeIt(): void
    {

        $parser = new CSVParser;

        $string = 'This is a string that contains an email myemail@company.com as an example';

        $this->assertEquals(
            'This is a string that contains an email *******@company.com as an example',
            $parser->hasPhoneOrEmail($string)
        );
    }

    /**
     * Testing if has Phone and email and anonymize it
     */
    public function testCheckIfHasPhoneAndEmailAndAnonymizeIt(): void
    {

        $parser = new CSVParser;

        $string = 'My phone number is +34 977 222 333 and my email is myemail@company.com.';

        $this->assertEquals(
            'My phone number is ****** 333 and my email is *******@company.com.',
            $parser->hasPhoneOrEmail($string)
        );
    }

    /**
     * Testing to create csv file and process it
     */
    public function testLoadAndProcessCSVFile(): void
    {

        $parser = new CSVParser;

        $example = array (
            array('aaa', 'bbb', 'ccc'),
            array('123', '456', '789'),
            array('"aaa"', '"bbb"','ee,3')
        );
        
        $fp = fopen('testPhpUnit.csv', 'w');
        foreach ($example as $line) fputcsv($fp, $line);
        fclose($fp);   

        $parser->load('testPhpUnit.csv');

        $this->assertEquals(
            $example,
            $parser->getData()
        );

        unlink('testPhpUnit.csv');
    }

   
}