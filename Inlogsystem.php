<?php
class Inlogsystem
{
    private $userid;

    public function __construct()
    {
        $this->userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : null;
    }

    public function getUserid()
    {
        return $this->userid;
    }


    public function logoff()
    {
        unset($_SESSION["userid"]);
        $this->userid = null;
    }

}