<?php

namespace AppBundle\Controller\Config;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Country;
use AppBundle\Form\CountryType;
use Symfony\Component\HttpFoundation\Request;


class CountryConfigController extends Controller
{
    /**
     * @Route("/config/country/", name="countryConfigIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('AppBundle:Country')->findAllCountries();
        return ['countries' => $countries];
    }

    /**
     * @Route("/config/country/add", name="countryConfigAdd")
     * @Method("GET")
     */
    public function addAction()
    {
        return [];
    }

    /**
     * @Route("/config/country/{countryId}/edit", requirements={"countryId": "\d+"}, name="countryConfigEdit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, $countryId)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')->findCountryById($countryId);
        $editForm = $this->createForm(CountryType::class, $country);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($country);
            $em->flush();
            return $this->redirectToRoute('countryConfigIndex');
        }
        return ['edit_form' => $editForm->createView()];
    }

    /**
     * @Route("/config/country/{countryId}/delete", requirements={"countryId": "\d+"}, name="countryConfigDelete")
     * @Method("GET")
     */
    public function deleteAction()
    {
        return [];
    }
}