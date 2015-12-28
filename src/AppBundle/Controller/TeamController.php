<?php

namespace AppBundle\Controller;

use AppBundle\Model\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    /**
     * @Route("/team/view/{teamName}", requirements={"teamName": "[-A-Za-z\x20\.\']+"}, name="teamView")
     * @Method("GET")
     * @Template()
     */
    public function viewAction($teamName)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->findTeamByName($teamName);
        return ['team' => $team];
    }
}
