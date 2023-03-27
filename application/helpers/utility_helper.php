<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function asset_url(){
   return base_url().'assets/';
   // return str_replace('gogarbha_manage/','',base_url()).'assets/';
}



function front_url(){
	return 'http://3.109.1.213/miracledrink/';
}

function no_cache()
{
    header("HTTP/1.0 200 OK");
    header("HTTP/1.1 200 OK");
    header("Expires: Mon, 26 Jul 1990 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
if (!function_exists('miracleEncrypt')) {   
function miracleEncrypt($string) {        
        $secret_key = 'miracledrink';
        $secret_iv = 'miracledrink@123';  
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );        
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        return $output;
    }
}

if (!function_exists('miracleDcrypt')) {   
    function miracleDcrypt($string) {     
        $secret_key = 'miracledrink';
        $secret_iv = 'miracledrink@123';  
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );    
        return $output;
    }
}
?>