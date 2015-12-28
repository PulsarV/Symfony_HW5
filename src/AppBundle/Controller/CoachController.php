<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoachController extends Controller
{
    /**
     * @Route("/coach/view/{teamName}/{coachName}", requirements={"teamName": "[-A-Za-z\x20\.\']+", "coachName": "[-A-Za-z\x20\.\']+"}, name="coachView")
     * @Method("GET")
     * @Template()
     */
    public function viewAction($teamName, $coachName)
    {
        $em = $this->getDoctrine()->getManager();
        $coach = $em->getRepository('AppBundle:Coach')->findCoachByTeam($teamName, $coachName);
        return ['coach' => $coach];
    }

    /**
     * @Route("/coach/view/{teamName}", requirements={"teamName": "[-A-Za-z\x20\.\']+"}, name="coachIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($teamName)
    {
        $em = $this->getDoctrine()->getManager();
        $coaches = $em->getRepository('AppBundle:Coach')->findAllCoachesByTeam($teamName);
        return ['coaches' => $coaches];
    }
}
