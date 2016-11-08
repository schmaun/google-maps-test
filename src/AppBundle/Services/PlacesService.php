<?php

namespace AppBundle\Services;

class PlacesService
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * PlacesService constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function details($reference)
    {
        $google_places = new \joshtronic\GooglePlaces($this->apiKey);
        $google_places->placeid = $reference;

        return $google_places->details();
    }
}
