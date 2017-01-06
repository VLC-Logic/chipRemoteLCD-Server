<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIController extends Controller
{
    public function helloAction()
    {
        return array('msg' => 'Per la boca, TIRE FOC!', 'date' => date('H:i:s \O\n d/m/Y'));
    }
}
