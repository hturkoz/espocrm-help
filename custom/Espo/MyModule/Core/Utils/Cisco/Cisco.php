<?php

namespace Espo\MyModule\Core\Utils\Cisco;

use stdClass;

class Cisco
{

    public static function CiscoExecute(string $extension, ?string $phoneNumber ) : array
    {   
        if (!$phoneNumber || !$extension){
            return [
                'status' => false, 
                'message' => 'Espo\MyModule\Core\Utils\Cisco::CiscoExecute:', 
                'phoneNumber' => 'phoneNumber error: ' .$phoneNumber
            ];
        }

        switch ($extension)
        {
            case 101 : 
                $phoneIp = '10.0.0.51';
                break;
            case 102 : 
                $phoneIp = '10.0.0.52';
                break;
            case 103 : 
                $phoneIp = '10.0.0.53';
                break;
            case 104 : 
                $phoneIp = '10.0.0.54';
                break;
            case 105 : 
                $phoneIp = '10.0.0.55';
                break;
            case 106 : 
                $phoneIp = '10.0.0.56';
                break;
            case 107 : 
                $phoneIp = '10.0.0.57';
                break;
            case 108 : 
                $phoneIp = '10.0.0.58';
                break;
            case 109 : 
                $phoneIp = '10.0.0.59';
                break;
            case 110 : 
                $phoneIp = '10.0.0.60';
                break;
            default :
                return [
                'status' => false, 
                'message' => "Extension {$extension} have no IPPhone Configured", 
                'phoneNumber' => $phoneNumber
            ];
        }


        $url = "http://{$phoneIp}/CGI/Execute";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
           "Content-Type: text/xml",
           "Accept: text/xml",
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $postData = 'XML=<CiscoIPPhoneExecute><ExecuteItem Priority="0" URL="Dial:' .$phoneNumber .'"/></CiscoIPPhoneExecute>';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return [
                'status' => true, 
                'message' => "Extension {$extension} is calling {$phoneNumber}", 
                'phoneNumber' => $phoneNumber
            ];

    }
}
