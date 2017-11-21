<?php

namespace Controllers;

use Models\BeerModel;

class BeerController extends Controller {

    /** @var \Pintlabs_Service_Brewerydb $connection */
    private $connection;

    /**
     * BeerController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->connection = parent::connect();
    }

    /**
     * Returns a random beer with title, image and description
     * @return BeerModel|null
     */
    public function randomBeer() {

        $randomBeer = null; // Set to a default

        $params['withBreweries'] = 'Y';
        $params['hasLabels'] = 'Y';

        try {
            $results = $this->connection->request('beer/random', $params, 'GET');
        } catch (Exception $e) {
            $results = array('error' => $e->getMessage());
        }

        if ( $results['data'] !== null ) {
            $randomBeer = $this->setBeer(
                $results['data']['id'],
                $results['data']['name'],
                isset($results['data']['description']) ? $results['data']['description'] : null,
                $results['data']['labels']['icon'],
                $results['data']['breweries'][0]['id'],
                $results['data']['breweries'][0]['name']
            );
        }

        return $randomBeer;

    }

    /**
     * Search a beer, brewery or get all beers from a specific brewery
     * @param $name
     * @param null $searchType
     * @param bool $sameBrewery
     * @return array
     */
    public function searchBeer($name, $searchType = null, $sameBrewery = false){

        $params = array();
        $beers = array();

        if ( $sameBrewery ) {
            $type = '/brewery/'.$name.'/beers';
        } else {
            $type = 'search';
            $params['q'] = $name;
            $params['type'] = $searchType;
            $params['withBreweries'] = 'Y';
            $params['hasLabels'] = 'Y';
        }

        try {
            $results = $this->connection->request($type, $params, 'GET');
        } catch (Exception $e) {
            $results = array('error' => $e->getMessage());
        }

        if ( $results['data'] !== null ) {
            foreach ($results['data'] as $key => $result) {

                /* Remove the beers without description
                 * Unfortunately, the API doesn't provide any filter for this.
                 */
                if ($this->filterBeers($result)) {
                    unset($results['data'][$key]);
                    continue;
                }

                $beers[] = $this->setBeer(
                    $result['id'],
                    $result['name'],
                    $result['description'],
                    isset($result['labels']['icon']) ? $result['labels']['icon'] : $result['images']['icon'],
                    isset($result['breweries'][0]['id']) ? $result['breweries'][0]['id'] : null,
                    isset($result['breweries'][0]['name']) ? $result['breweries'][0]['name'] : null
                );

            }
        }

        return $beers;

    }

    /**
     * Set the BeerModel for the view
     * @param $id
     * @param $name
     * @param $description
     * @param $icon
     * @param $breweryId
     * @param $breweryName
     * @return BeerModel
     */
    public function setBeer($id, $name, $description, $icon, $breweryId, $breweryName){

        /** @var BeerModel $beerModel */
        $beerModel = new BeerModel($id, $name, $description, $icon, $breweryId, $breweryName );
        return $beerModel;

    }

    /**
     * Filter the beers if it doesn't have an image or description.
     * @param $beer array
     * @return bool
     */
    public function filterBeers($beer){
        if ( !isset($beer['description']) || ( !isset($beer['labels']['icon']) && !isset($beer['images']['icon']) ) ) {
            return true;
        }
    }

}
