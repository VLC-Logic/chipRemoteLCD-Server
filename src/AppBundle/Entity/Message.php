<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent", type="datetime", nullable=true)
     */
    private $sent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recv", type="datetime", nullable=true)
     */
    private $recv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="readDevice", type="datetime", nullable=true)
     */
    private $readDevice;


    /**
     * @ORM\ManyToOne(targetEntity="Device", inversedBy="devices")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     */
    private $device;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }


    /**
     * Set sent
     *
     * @param \DateTime $sent
     *
     * @return Message
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return \DateTime
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set recv
     *
     * @param \DateTime $recv
     *
     * @return Message
     */
    public function setRecv($recv)
    {
        $this->recv = $recv;

        return $this;
    }

    /**
     * Get recv
     *
     * @return \DateTime
     */
    public function getRecv()
    {
        return $this->recv;
    }

    /**
     * Set readDevice
     *
     * @param \DateTime $readDevice
     *
     * @return Message
     */
    public function setReadDevice($readDevice)
    {
        $this->readDevice = $readDevice;

        return $this;
    }

    /**
     * Get readDevice
     *
     * @return \DateTime
     */
    public function getReadDevice()
    {
        return $this->readDevice;
    }
}

