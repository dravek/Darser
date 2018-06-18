<?php

namespace Darser\Output;

use SimpleXMLElement;

class XMLParser
{

    /**
     * Data to be written in XML file
     */
    private $data;

    /**
     * Returns $data value
     * 
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * Converts Array to XML
     * 
     * @param array array
     * @param xmldata xmlData
     * @param string header
     */
    function convertArrayToXML($array,$xmlData,$header) 
    {
        foreach($array as $key => $value) {
            
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xmlData->addChild("element$key");
                    $this->convertArrayToXML($value, $subnode,$header);
                }else{
                    $subnode = $xmlData->addChild("item$key");
                    $this->convertArrayToXML($value, $subnode,$header);
                }
            }else {
                if($header)$xmlData->addChild("$header[$key]",htmlspecialchars("$value"));
                else $xmlData->addChild("col$key",htmlspecialchars("$value"));
            }
        }
    }


    /**
     * Converts an Array to XML using convertArrayToXML function
     * 
     * @param array array
     * @param bool hasHeader (Uses first CSV line to name XML record fields)
     */
    public function convert($array, $hasHeader=false)
    {
        $this->data = new SimpleXMLElement("<?xml version=\"1.0\"?><dataParser></dataParser>");

        if($hasHeader == true) $header = array_shift($array);
        $this->convertArrayToXML($array,$this->data, $header);
    }


    /**
     * Saves XML data in file
     * 
     * @param string
     * @return bool
     */
    public function save($fileName)
    {
        if($this->data->asXML($fileName)) return true;
        return false;
    }
    
}
