<?php

namespace AppBundle\Controller\Config;

use AppBundle\Entity\Team;
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
        if (!$countries) {
            throw $this->createNotFoundException('Unable to find Country.');
        }
        return ['countries' => $countries];
    }

    /**
     * @Route("/config/country/add", name="countryConfigAdd")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function addAction(Request $request)
    {
        $country = new Country();
        $addForm = $this->createForm(CountryType::class, $country);
        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid() && (null !== $country->getFlagImg())) {
            $country->getFlagImg()->move(__DIR__.'/../../../../web/images', $country->getFlagImg()->getClientOriginalName());
            $country->setFlag($country->getFlagImg()->getClientOriginalName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();
            return $this->redirectToRoute('countryConfigIndex');
        }
        return ['add_form' => $addForm->createView()];
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
        if (!$country) {
            throw $this->createNotFoundException('Unable to find Country.');
        }
        $editForm = $this->createForm(CountryType::class, $country);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if (null !== $country->getFlagImg()) {
                $country->getFlagImg()->move(__DIR__.'/../../../../web/images', $country->getFlagImg()->getClientOriginalName());
                $country->setFlag($country->getFlagImg()->getClientOriginalName());
            }
            $country->getTeam()->setName($country->getName());
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
    public function deleteAction($countryId)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')->findCountryById($countryId);
        if (!$country) {
            throw $this->createNotFoundException('Unable to find Country.');
        }
        $em->remove($country);
        $em->flush();
        return $this->redirectToRoute('countryConfigIndex');
    }
}