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
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $address = $request->get('address', 'Berlin');
        $geoCoderRequest = new GeocoderAddressRequest($address);
        $geoCoderRequest->setLanguage('de');
        $geoCoderRequest->setComponents([
            GeocoderComponentType::COUNTRY => 'DE'
        ]);

        $response = $this->get('own_geocoder')->geocodeRaw($geoCoderRequest);


        return $this->render('default/index.html.twig', [
            'address' => $address,
            'response' => print_r($response, true),
        ]);
    }
}
