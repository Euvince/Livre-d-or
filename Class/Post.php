<?php

namespace App;

class Post {

    public $id;

    public $name;

    public $content;

    public $created_at;

    public function __construct()
    {
        if (is_int($this->created_at) || is_string($this->created_at)): 
            $this->created_at = new \DateTime('@' . $this->created_at);
        endif;
    }

    public function getExcerpt(): string
    {
        return substr($this->content, 0, 150);
    }

    public function getBody(): string
    {
        $parseDown = new \ParseDown(); //JE DOIS INSTALLER LA LIBRAIRIE
        $parseDown->setSafeMode(true);
        return $parseDown->text($this->content);
    }

}