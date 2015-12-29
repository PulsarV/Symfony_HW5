<?php

namespace AppBundle\Controller\Config;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexConfigController extends Controller
{
    /**
     * @Route("/config/", name="homeConfigPage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirectToRoute('countryConfigIndex');
    }
}
