<?php

namespace Task\Model;

use DateTime;

class Post
{
    private $postId;
    private $fromName;
    private $fromId;
    private $message;
    private $type;
    private $createdAt;

    public function __construct(array $data = [])
    {
        if(
            !empty($data['id'] && !empty($data['message']))
        ) {
            $this->setId($data['id']);
            $this->setFromName($data['from_name']);
            $this->setFromId($data['from_id']);
            $this->setMessage($data['message']);
            $this->setType($data['type']);
            $this->setCreatedTime(new DateTime($data['created_time']));
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->postId;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->postId = $id;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $from_name
     */
    public function setFromName(string $from_name): void
    {
        $this->fromName = $from_name;
    }

    /**
     * @return string
     */
    public function getFromId()
    {
        return $this->fromId;
    }

    /**
     * @param string $from_id
     */
    public function setFromId(string $from_id): void
    {
        $this->fromId = $from_id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $created_time
     */
    public function setCreatedTime(DateTime $created_time): void
    {
        $this->createdAt = $created_time;
    }
}