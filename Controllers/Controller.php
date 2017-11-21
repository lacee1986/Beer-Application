<?php

namespace Controllers;

use Pintlabs_Service_Brewerydb;

/**
 * Class Controller
 * @package Controllers
 */
class Controller {

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Controller constructor.
     * Would be nice to keep the key in a .env file and load it from there.
     */
    public function __construct() {
        $this->apiKey = '8000fe35133545b8e98842c3db907917'; // This should be outside of the git repo in a .env file
    }

    /**
     * Connect to the API and pass it to our Controller
     * @return Pintlabs_Service_Brewerydb
     */
    public function connect(){
        $bdb = new Pintlabs_Service_Brewerydb($this->apiKey);
        $bdb->setFormat('php');
        return $bdb;
    }

    /**
     * Basic filter for the input field to only accept numbers, letters, spaces and hyphens
     * @param $input string
     * @return bool
     */
    public function sanitizer($input){
        $validation = preg_match('/^[a-z0-9 .\-]+$/i', $input);
        if ( $validation === 1 ) {
            return true;
        } else {
            return false;
        }
    }

}
