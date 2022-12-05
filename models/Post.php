<?php

class Post
{
    public $title;
    public $author;
    public $url;

    public function __construct()
    {
        $this->db = new Database();
        $this->title = '';
        $this->author = '';
        $this->url = '';
    }

    public function set($iTitle, $iAuthor, $iUrl)
    {
        $this->title = $iTitle;
        $this->author = $iAuthor;
        $this->url = $iUrl;
    }

    public function save()
    {
        $this->db->prepare("INSERT INTO posts (title, author, url) VALUES ('" . $this->title . "','" . $this->author . "','" . $this->url . "');");
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
}
