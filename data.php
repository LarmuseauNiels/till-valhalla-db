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
            Output::showtitle("database browser");

            break;
        case "character":
            Output::showtitle("database browser");
            $characters = $DBtools->getUserCharacters($userid);
            Output::characterChooser($characters);
            break;
        case "members":
            Output::showtitle("database browser");
            $Objectarray = $DBtools->getMembers();
            var_dump($Objectarray);
            $arrlength = count($Objectarray);
            $collumsize = 3;
            for ($i = 0; $i < $arrlength; $i++) {
                echo '<div class="row">';
                foreach ($Objectarray[$i] as $x => $x_value) {
                    echo '<div class="col-sm-' . $collumsize . '"><p>' . $x_value . '</p></div>';
                }
                echo '</div>';
            }
            break;
        case "stat":
            Output::showtitle("database browser");
            $tablename = isset($_GET["tablename"]) ? $_GET["tablename"] : "crafting";
            $Objectarray = $DBtools->getTabel($tablename);
            $arrlength = count($Objectarray);
            $collumsize = 3;
            for ($i = 0; $i < $arrlength; $i++) {
                echo '<div class="row">';
                foreach ($Objectarray[$i] as $x => $x_value) {
                    if ($x == "characterid") {
                        $a = $DBtools->getUserFromCharacters($x_value);
                        $b = $DBtools->getUserFromID($a->userid);
                        echo '<div class="col-sm-' . $collumsize . '"><p>' . $b->username . '</p></div>';
                        echo '<div class="col-sm-' . $collumsize . '"><p>' . $a->charactername . '</p></div>';
                    }
                    else {echo '<div class="col-sm-' . $collumsize . '"><p>' . $x_value . '</p></div>';}
                }
                echo '</div>';
            }
            break;
        default:
        header("Location: member.php");
            break;
    }
    Output::PageEnd();
    $DBtools->closeDB();
} else {
    //not authenticated
    header("Location: index.php");
}


