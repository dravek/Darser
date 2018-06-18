<?php

declare(strict_types=1);
namespace Darser\Tests;

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Darser\Output\XMLParser;
use SimpleXMLElement;

final class XMLParserTest extends TestCase
{

    /**
     * Testing converting array to xml
     */
    public function testConvertArrayToXML(): void
    {
        $parser = new XMLParser();
        $csv[] = ['1','david'];
        $csv[] = ['2','Laia'];

        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><dataParser><item0><col0>1</col0><col1>david</col1></item0><item1><col0>2</col0><col1>Laia</col1></item1></dataParser>");;

        $parser->convert($csv);
        
        $this->assertEquals(
            $xml,
            $parser->getData()
        );
    }

   
}