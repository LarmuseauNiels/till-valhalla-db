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
        case "character":
            Output::showtitle("Character Page");
            $characterid = isset($_GET["characterid"]) ? $_GET["characterid"] : "";
            $character = $DBtools->getUserFromCharacters($characterid);
            $collumsize = 4;
            $arrlength = count($character);
            echo '<div class="row">
            <div class="col-sm-'.$collumsize.'"><p>charactername</p></div>
            <div class="col-sm-'.$collumsize.'"><p>userid</p></div>
            <div class="col-sm-'.$collumsize.'"><p>characterid</p></div>
            </div>';
            echo '<div class="row">';
            foreach ($character as $x => $x_value) {
                echo '<div class="col-sm-' . $collumsize . '"><p>' . $x_value . '</p></div>';}
            echo '</div>';
            echo '<div class="tabbable boxed parentTabs">
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#crafting">Crafting</a></li>
                        <li><a data-toggle="pill" href="#gathering">Gathering</a></li>
                        <li><a data-toggle="pill" href="#refining">Refining</a></li>
                        <li><a data-toggle="pill" href="#farming">Farming</a></li>
                        <li><a data-toggle="pill" href="#equip">Equip</a></li>
                    </ul>
                    <div class="tab-content">
                    <div id="crafting" class="tab-pane fade in active">';

            echo '</div><div id="gathering" class="tab-pane fade">';
            echo '</div><div id="refining" class="tab-pane fade">';
            echo '</div><div id="farming" class="tab-pane fade">';
            echo '</div><div id="equip" class="tab-pane fade">';
            echo '</div></div>';
            break;
        case "member":
            Output::showtitle("User page");
            $memberid = isset($_GET["userid"]) ? $_GET["userid"] : "";
            $member = $DBtools->getUserFromID($memberid);
            $collumsize = 3;
            echo '<div class="row">
            <div class="col-sm-'.$collumsize.'"><p>userid</p></div>
            <div class="col-sm-'.$collumsize.'"><p>Username</p></div>
            <div class="col-sm-'.$collumsize.'"><p>discriminator</p></div>
            <div class="col-sm-'.$collumsize.'"><p>last login</p></div>
            </div>';
            $arrlength = count($member);
            echo '<div class="row">';
            foreach ($member as $x => $x_value) {echo '<div class="col-sm-' . $collumsize . '"><p>' . $x_value . '</p></div>';}
            echo '</div>';
            $characters = $DBtools->getUserCharacters($memberid);
            $collumsize = 4;
            $arrlength = count($characters);
            echo '<div class="row">
            <div class="col-sm-'.$collumsize.'"><p>charactername</p></div>
            <div class="col-sm-'.$collumsize.'"><p>userid</p></div>
            <div class="col-sm-'.$collumsize.'"><p>characterid</p></div>
            </div>';
            for ($i = 0; $i < $arrlength; $i++) {
                echo '<div class="row">';
                foreach ($characters[$i] as $x => $x_value) {
                    echo '<div class="col-sm-' . $collumsize . '"><p>' . $x_value . '</p></div>';
                }
                echo '</div>';
            }
            break;
        case "members":
            Output::showtitle("Members");
            $Objectarray = $DBtools->getMembers();
            $arrlength = count($Objectarray);
            $collumsize = 3;
            echo '<div class="row">
            <div class="col-sm-'.$collumsize.'"><p>Discord ID</p></div>
            <div class="col-sm-'.$collumsize.'"><p>Username</p></div>
            <div class="col-sm-'.$collumsize.'"><p>discriminator</p></div>
            <div class="col-sm-'.$collumsize.'"><p>last login</p></div>
            </div>';
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
            echo '<div class="row">
            <div class="col-sm-'.$collumsize.'"><p>Username</p></div>
            <div class="col-sm-'.$collumsize.'"><p>Charactername</p></div>
            <div class="col-sm-'.$collumsize.'"><p>categoriser</p></div>
            <div class="col-sm-'.$collumsize.'"><p>tier</p></div>
            </div>';
            for ($i = 0; $i < $arrlength; $i++) {
                echo '<div class="row">';
                foreach ($Objectarray[$i] as $x => $x_value) {
                    if ($x == "characterid") {
                        $a = $DBtools->getUserFromCharacters($x_value);
                        $b = $DBtools->getUserFromID($a->userid);
                        echo '<div class="col-sm-' . $collumsize . '"><a href="?actie=member&userid='.$b->userid.'">'.$b->username.'</a></div>';
                        echo '<div class="col-sm-' . $collumsize . '"><a href="?actie=character&characterid='.$a->characterid.'">'.$a->charactername.'</a></div>';
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


