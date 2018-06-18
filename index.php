<?php

/**
 * EXAMPLE of use for Darser Class
 * 
 * $parser = new Darser( inputType , outputType );
 * $parser->input->load( inputFile );
 * $parser->convert( hasHeader = false );
 * $parser->output->save( outputFile )
 * 
 * 
 */

require __DIR__ . '/vendor/autoload.php';

use Darser\Darser;

$parser = new Darser('CSV','XML');

$parser->input->load('sample.csv');
$parser->convert(true); //set to false if first line don't contain headers
if($parser->output->save('output.xml')) echo "File converted Succesfully";

