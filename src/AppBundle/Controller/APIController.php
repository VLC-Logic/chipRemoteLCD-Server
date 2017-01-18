<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\RequestParam as RequestParam;

class APIController extends FOSRestController
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
     * @Rest\Get("/messages")
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

    /**
     * @Rest\Post("/message")
     *
     * @RequestParam(name="userid", requirements="\d+", nullable=false, strict=true, description="User Id")
     * @RequestParam(name="deviceid", requirements="\d+", nullable=false, strict=true, description="Device Id")
     * @RequestParam(name="msg", requirements="\w+", default="empty", description="Message")
     *
     * @param Request $request
     *
     * @return View
     */
    public function postMessageAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($request->get('userid'));
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$request->get('userid')
            );
        }
        $device = $this->getDoctrine()
            ->getRepository('AppBundle:Device')
            ->find($request->get('deviceid'));
        if (!$device) {
            throw $this->createNotFoundException(
                'No device found for id '.$request->get('deviceid')
            );
        }

        $message = new Message();;
        $message->setUser($user);
        $message->setDevice($device);
        $message->setText($request->get('msg'));
        $view = View::create();
        $errors = $this->get('validator')->validate($message);
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $view->setData($message)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }

}
