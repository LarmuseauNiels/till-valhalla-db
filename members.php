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
    $formprosessing = isset($_GET["form"]) ? $_GET["form"] : "";
    switch ($formprosessing) {
        case "charedit":
            foreach ($_POST as $key => $value) {
                if ($DBtools->checkcharid($_GET["charid"], $userid)) {
                    if ($value > 0) {
                        $tabletoinsertinto = substr($key, 0, strpos($key, "*"));
                        $categoriser = substr($key, strpos($key, "*") + 1);
                        if ($DBtools->doesTableIntryExist($tabletoinsertinto, $_GET["charid"], $categoriser)) {
                            $DBtools->updateToTabel($tabletoinsertinto, $_GET["charid"], $categoriser, $value);
                        } else {
                            $DBtools->addToTabel($tabletoinsertinto, $_GET["charid"], $categoriser, $value);
                        }
                    }
                    else{Output::error('MFCENV');}
                }
                else{Output::error('MFCEF');}
            }
            break;
        case "createcharacter":
            if (isset($_POST["charactername"])) {
                Output::error('MFCCT');
                $charactername = $_POST["charactername"];
                $DBtools->createCharacter($userid, $charactername);
                header("Location: members.php?actie=charsel");
            }
            else{Output::error('MFCCF');}
            break;
        default:
            break;
    }

    switch ($actie) {
        case "logout":
            $authenticator->logoff();
            header("Location: index.php");
            break;
        case "charsel":
            Output::showtitle("Character chooser");
            $characters = $DBtools->getUserCharacters($userid);
            Output::characterChooser($characters);
            break;
        case "charedit":
            if ($DBtools->checkcharid($_GET["charid"], $userid)) {
                Output::showtitle("Character edit");
                Output::ShowCharacterEditor($DBtools);
            }
            else{Output::error('MCEF');}
            break;
        case "charrem":
            if ($DBtools->checkcharid($_GET["charid"], $userid)) {
                Output::error('MCRT');
                $DBtools->removeCharacter($_GET["charid"]);
                header("Location: members.php?actie=charsel");
            }
            else{Output::error('MCRF');}
            break;
        case "charsearch":
            header("Location: data.php");
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


