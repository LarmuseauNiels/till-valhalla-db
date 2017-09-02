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
                //preforme successmesage and transfer
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
        case "charsel":
            Output::showtitle("Character chooser");
            echo $userid;
            $characters = $DBtools->getUserCharacters($userid);
            var_dump($characters);
            //$_SESSION["selectedcharackterid"] = $this->userid;
            Output::characterChooser($characters);
            //Output::ShowCharacterEditor();
            break;
        case "charedit":
            Output::showtitle("Character edit");
            Output::ShowCharacterEditor();
            break;
        case "charrem":
            $DBtools->removeCharacter($_GET["charid"]);
            header("Location: members.php?actie=charsel");
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


