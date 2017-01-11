<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class APIController extends Controller
{
    /**
     * @Rest\Get("/user/{id}")
     */
    public function getUserByIdAction(Request $request)
    {
        $userid = $request->get('id');

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($userid);

        return $user;
    }

    /**
     * @Rest\Get("/user")
     */
    public function getUserAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $users;
    }

    /**
     * @Rest\Get("/device")
     */
    public function getDeviceAction()
    {
        $devices = $this->getDoctrine()
            ->getRepository('AppBundle:Device')
            ->findAll();

        return $devices;
    }

    /**
     * @Rest\Get("/device/{id}")
     */
    public function getDeviceByIdAction(Request $request)
    {
        $deviceid = $request->get('id');

        $device = $this->getDoctrine()
            ->getRepository('AppBundle:Device')
            ->find($deviceid);

        return $device;
    }

    /**
     * @Rest\Get("/message")
     */
    public function getMessagesAction()
    {
        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findAll();
        return $messages;
    }

    /**
     * @Rest\Get("/device/{deviceid}/message")
     */
    public function getMessageByDeviceIdAction(Request $request)
    {
        $deviceid = $request->get('deviceid');

        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByDevice($deviceid);

        return $messages;
    }

    /**
     * @Rest\Get("/user/{userid}/message")
     */
    public function getMessageByUserId(Request $request)
    {
        $userid = $request->get('userid');

        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByUser($userid);

        return $messages;
    }

    /**
     * @Rest\Get("/device/{deviceid}/user/{userid}/message")
     */
    public function getMessageByDeviceIdAndUserIdAction(Request $request)
    {
        $deviceid = $request->get('deviceid');
        $userid = $request->get('userid');

        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findBy(array(
                'device' => $deviceid,
                'user' => $userid
            ));
        return $messages;
    }

}
