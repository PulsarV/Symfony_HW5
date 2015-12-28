<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CountryController extends Controller
{
    /**
     * @Route("/country/view/{countryName}", requirements={"countryName": "[-A-Za-z\x20\.\']+"}, name="countryView")
     * @Method("GET")
     * @Template()
     */
    public function viewAction($countryName)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')->findCountryByName($countryName);
        return ['country' => $country];
    }

    /**
     * @Route("/country/view/", name="countryIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('AppBundle:Country')->findAllCountries();
        return ['countries' => $countries];
    }
}
