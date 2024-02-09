<?php

namespace domain;
class Post
{
    protected $id;
    protected $title;
    protected $body;
    protected $date;
    protected $User;

    public function __construct($id, $title, $body, $date, $User)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->User = $User;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getUser()
    {
        return $this->User;
    }
}