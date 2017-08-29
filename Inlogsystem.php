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

    public function login($user)
    {
        $DBtools = DBtools::getdbinstance();
        $this->userid = $user->id;
        if ($DBtools->doesUserExist($this->userid))
        {
            $_SESSION["userid"] = $this->userid;
        }
        else
        {
            $DBtools->addUser($user->id,$user->username,$user->discriminator,date('Y-m-d H:i:s'));
            $_SESSION["userid"] = $this->userid;
        }
    }

    public function adduser($user)
    {
        $DBtools = DBtools::getdbinstance();
        $DBtools->addUser($user->id,$user->username,$user->discriminator,date('Y-m-d H:i:s'));
    }

}