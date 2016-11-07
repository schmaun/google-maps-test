<?php

namespace AppBundle\Controller;

use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/geocoder", name="geocoder")
     */
    public function geocoderAction(Request $request)
    {
        $address = $request->get('q', 'Berlin');
        $geoCoderRequest = new GeocoderAddressRequest($address);
        $geoCoderRequest->setLanguage('de');
        $geoCoderRequest->setComponents([
            GeocoderComponentType::COUNTRY => 'DE'
        ]);

        $geocodeRaw = $this->get('own_geocoder')->geocodeRaw($geoCoderRequest);


        return $this->render('default/index.html.twig', [
            'request' => $address,
            'response' => print_r($geocodeRaw, true),
        ]);
    }

    /**
     * @Route("/placesDetails", name="placesDetails")
     */
    public function placesDetailsAction(Request $request)
    {
        $reference = $request->get('q');
        $placesService = $this->get('places')->details($reference);


        return $this->render('default/index.html.twig', [
            'request' => $reference,
            'response' => print_r($placesService, true),
        ]);
    }
}
