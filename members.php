<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

if(isset($userid))
{
    //authenticated
    $DBtools = DBtools::getdbinstance();
    $user = $DBtools->getUserFromID($userid);// get active user
    $actie = isset($_GET["actie"]) ? $_GET["actie"] : "";
    Output::navigationbar();
    switch ($actie)
    {
        case "logout":
            $authenticator->logoff();
            header("Location: index.php");
            break;
        case "charedit":
            Output::showtitle("Character edit");

            break;
        case "charsearch":
            Output::showtitle("Character browser");
            break;
        case "home":
        default:
            Output::showtitle("Home");

        break;
    }

    $dbtools->closeDB();
}
else
{
    //not authenticated
    header("Location: index.php");
}

require_once 'HTMLtail.php';

