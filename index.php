<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

if(!isset($userid))
{
    //not authenticated
    Output::showtitle("Log in with discord");
    Output::showdiscordauthentication();

    $actie = isset($_GET["actie"])? $_GET["actie"] : "";

}
else
{
    //authenticated
    header("Location: members.php");
}

require_once 'HTMLtail.php';