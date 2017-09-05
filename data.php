<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

if (isset($userid)) {
    //authenticated
    $DBtools = DBtools::getdbinstance();
    $user = $DBtools->getUserFromID($userid);// get active user
    $actie = isset($_GET["actie"]) ? $_GET["actie"] : "";
    Output::navigationbar();

    switch ($actie) {
        case "user":
            $authenticator->logoff();
            header("Location: index.php");
            break;
        case "character":
            Output::showtitle("Character chooser");
            $characters = $DBtools->getUserCharacters($userid);
            Output::characterChooser($characters);
            break;
        case "stats":
            if ($DBtools->checkcharid($_GET["charid"], $userid)) {
                Output::showtitle("Character edit");
                Output::ShowCharacterEditor($DBtools);
            }
            break;
        case "charrem":
            if ($DBtools->checkcharid($_GET["charid"], $userid)) {
                removeCharacter($_GET["charid"]);
                header("Location: members.php?actie=charsel");
            }
            break;
        case "charsearch":
            Output::showtitle("Character browser");

            $DBtools->stattabledisplayer("crafting");
            break;
        case "home":
        default:
            Output::showtitle("Home");
            break;
    }
    Output::PageEnd();
    $DBtools->closeDB();
} else {
    //not authenticated
    header("Location: index.php");
}


