<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('setAPI')) {
    function setAPI()
    {
        return 'http://192.168.3.8/MasterDataP1Api/';
    }

    function setAPI2()
    {
        return 'http://192.168.3.8/UserDataP1Api/';
    }

    function setAPI3()
    {
        return 'http://192.168.0.4/OneLogin/';
    }

    function setAPI_sambupedia()
    {
        return 'http://192.168.3.36/sambupedia_api/';
    }
}
