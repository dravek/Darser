<?php

namespace Darser\Input;

//Compatibility with mac EOL
ini_set("auto_detect_line_endings", "1");

use Darser\Helpers\Anonymize as Anonymize;

class CSVParser
{

    /**
     * Data from CSV file
     */
    private $data;

    /**
     * Pattern for Email
     */
    protected $patternEmail = '/[\w.+-]+@[a-z0-9-]+(\.[a-z0-9-]+)*/i';

    /**
     * Pattern for Phone Number
     */
    protected $patternPhoneNumber = '/(([+]?34) ?)?(6(([0-9]{8})|([0-9]{2} [0-9]{6})|([0-9]{2} [0-9]{3} [0-9]{3}))|9(([0-9]{8})|([0-9]{2} [0-9]{6})|([1-9] [0-9]{7})|([0-9]{2} [0-9]{3} [0-9]{3})|([0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2})|([0-9]{2}-[0-9]{3}-[0-9]{3}-[0-9]{4})))|^[(]?[0-9]{3}[)]?[ ,-]?[0-9]{3}[ ,-]?[0-9]{4}$/';

    /**
     * Returns $data value
     *
     * @return data
     */
    public function getData(){
        return $this->data;
    }
    
    /**
     * Check if it contains phone or email and anonymize them
     *
     * @param string line
     * @return string
     */
    public function hasPhoneOrEmail($line)
    {

        if(preg_match_all($this->patternEmail, $line, $matches))
        {
            //In case there is more than one in the same line
            foreach($matches[0] as $match){
                $r= Anonymize::anonymizeEmail($match);
                $line = str_replace($match,$r,$line);
            }
        }

        if(preg_match_all($this->patternPhoneNumber, $line, $matches))
        {
            //In case there is more than one in the same line
            foreach($matches[0] as $match){
                $r= Anonymize::anonymizePhone($match);
                $line = str_replace($match,$r,$line);
            }
        }
   
        return $line;
    }


    /**
     * Loads content of CSV file into $data variable
     * 
     * @param string file
     * @return bool
     */
    public function load($file)
    {
        try {

            if(!is_readable($file)) throw new \Exception('File ' .$file. ' not found or is not readable.');
            
            $fileHandler = fopen($file, "r");
            
            while (($line = fgetcsv($fileHandler, 0, ",")) !== false) {

                $line = array_map(array($this, 'hasPhoneOrEmail'),$line);
                $this->data[] = $line;
            }

            fclose($fileHandler);
            return true;
        }
        catch(\Throwable $e) {

            echo 'Sorry.. We have encountered a problem: ' .$e->getMessage();
            return false;
        }   
    }
}
