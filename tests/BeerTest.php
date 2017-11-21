<?php

require_once '../vendor/autoload.php';
use Controllers\BeerController;
use Controllers\Controller;
use \PHPUnit_Framework_TestCase;

class BeerTest extends PHPUnit_Framework_TestCase {

    protected $apiKey = "8000fe35133545b8e98842c3db907917";
    protected $bdb;
    protected $controller;
    protected $beerController;

    public function __construct(){
        $this->controller = new Controller();
        $this->beerController = new BeerController();
        $this->bdb = new Pintlabs_Service_Brewerydb($this->apiKey);
        $this->bdb->setFormat('php');
    }

    public function testConnection(){
        //var_dump($this->bdb->getFormat());
        $this->assertTrue(is_object($this->bdb)); // Check connection
        $this->assertEquals('php', $this->bdb->getFormat()); // Check return format
    }

    public function testRequest(){
        $testParams['q'] = 'lager';
        $testParams['type'] = 'beer';
        $testParams['withBreweries'] = 'Y';
        $testParams['hasLabels'] = 'Y';
        $request = $this->bdb->request('search', $testParams, 'GET');
        $this->assertNotEmpty($request); // Check if not empty
        $this->assertTrue(is_array($request)); // Check for array
    }

    public function testForms(){
        $dummyKeyword = 'This Is 4 - Test';
        $sanitizedKeyword = $this->controller->sanitizer($dummyKeyword);
        $this->assertTrue($sanitizedKeyword);
    }

}