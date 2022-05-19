<?php

/**
 * All common functions.
 */

/**
 * Encode userid
 *
 * @param integer  $userId
 * @return encoded
 */
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Test Controller dummy method
function getUsers(){    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://122.170.1.83:8899/api/v1/user',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
