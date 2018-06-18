<?php

namespace Darser\Helpers;

class Anonymize
{

    /**
     * Anonymizes Emails
     * 
     * @param string email
     * @param int masks
     * @return string
     */
    public static function anonymizeEmail($email, $masks = 8)
    {
        $array = explode("@", $email);
        $length = strlen($array[0]);
        if ($length < $masks) $masks = $length;
        $result = substr($array[0], 0, -$masks) . str_repeat('*', $masks);
        return $result."@".$array[1];
    }

    
    /**
     * Anonymizes Phone Numbers
     * 
     * @param string phone
     * @return string
     */
    public static function anonymizePhone($phone)
    {
        return '******' . substr( $phone, - 4);
    }
}