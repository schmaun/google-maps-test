<?php

namespace AppBundle\Services;

use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;

class GeocoderService extends \Ivory\GoogleMap\Service\Geocoder\GeocoderService
{
    /**
     * @param GeocoderRequestInterface $request
     * @return \Psr\Http\Message\StreamInterface
     */
    public function geocodeRaw(GeocoderRequestInterface $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->build()));

        return $response->getBody()->getContents();
    }
}
