<?php

namespace Darser;

class Darser
{

    /**
     * Points to input class selected (CSV,XML,etc..)
     *
     * @var object
     */
    public $input;

     /**
     * Points to output class selected (CSV,XML,etc..)
     *
     * @var object
     */
    public $output;

    /**
     * Allowed Input File Extensions
     *
     * @var array
     */
    private $allowedInputTypes = ['CSV'];

    /**
     * Allowed Output File Extensions
     *
     * @var array
     */
    private $allowedOutputTypes = ['XML'];

    
    /**
     * Constructor checks if types can be converted
     * 
     * @param string inputType
     * @param string outputType
     * @return bool
     */
    public function __construct($inputType, $outputType)
    {
        $inputType = strtoupper($inputType);
        $outputType = strtoupper($outputType);
    
        if($this->validateFileTypes($inputType, $outputType))
        {    
            try{
                $class = 'Darser\\Input\\'.$inputType.'Parser';
                $this->input = new $class;

                $class = 'Darser\\Output\\'.$outputType.'Parser';
                $this->output = new $class;

            } catch (\Throwable $e) {
                echo $e->getMessage()."\n";
                return false;
            }

            return true;
        }
        return false;
    }

    /**
     * Checks if input and output file types are allowed
     * 
     * @param string inputType
     * @param string outputType 
     * @return bool
     */
    public function validateFileTypes($inputType, $outputType)
    {
        try{
            if(! in_array($inputType, $this->allowedInputTypes))
            {
                throw new \Exception($inputType.' is not a valid Input file type');
            }

            if(! in_array($outputType, $this->allowedOutputTypes))
            {
                throw new \Exception($outputType.' is not a valid Output file type');
            }

            return true;

        }catch(\Exception $e){
            echo "ERROR: ".$e->getMessage();
            return false;
        }
    }

    /**
     * Converts from input type to output type
     * 
     * @param bool hasHeader
     */
    public function convert($hasHeader=false)
    {
        $this->output->convert($this->input->getData(),$hasHeader);
    }

}
