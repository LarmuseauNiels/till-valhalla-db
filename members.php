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
    $formprosessing = isset($_GET["form"]) ? $_GET["form"] : "";
    switch ($formprosessing)
    {
        case "crafting":
            foreach($_POST as $key=>$value)
            {
                echo "$key=$value";
                //$DBtools->addToTabel("crafting",$characterid,$key,$value);
            }
            break;
        case "createcharacter":
            if (isset($_POST["charactername"])) {$charactername = $_POST["charactername"];
                $DBtools->createCharacter($userid,$charactername);

            }
            break;
        case "":
        case "home":
        default:
            
            break;
    }

    switch ($actie)
    {
        case "logout":
            $authenticator->logoff();
            header("Location: index.php");
            break;
        case "charedit":
            Output::showtitle("Character edit");
            echo $userid;
            $test = $DBtools->getUserCharacters($userid);
            var_dump($test);
            //$_SESSION["selectedcharackterid"] = $this->userid;
            Output::characterChooser();
            Output::ShowCharacterEditor();
            break;
        case "charsearch":
            Output::showtitle("Character browser");
            break;
        case "home":
        default:
            Output::showtitle("Home");
        break;
    }
    Output::PageEnd();

    $dbtools->closeDB();
}
else
{
    //not authenticated
    header("Location: index.php");
}


