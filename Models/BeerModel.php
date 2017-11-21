<?php

namespace Models;

class BeerModel {

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $icon;
    /**
     * @var string
     */
    private $breweryId;
    /**
     * @var string
     */
    private $breweryName;

    /**
     * BeerController constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $icon
     * @param string $breweryId
     * @param string $breweryName
     */
    public function __construct($id, $name, $description, $icon, $breweryId, $breweryName) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
        $this->breweryId = $breweryId;
        $this->breweryName = $breweryName;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getIcon() {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon) {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getBreweryId() {
        return $this->breweryId;
    }

    /**
     * @param string $breweryId
     */
    public function setBreweryId($breweryId) {
        $this->breweryId = $breweryId;
    }

    /**
     * @return string
     */
    public function getBreweryName() {
        return $this->breweryName;
    }

    /**
     * @param string $breweryName
     */
    public function setBreweryName($breweryName) {
        $this->breweryName = $breweryName;
    }



}
