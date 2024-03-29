<?php
class Output
{
    public static function showtitle($title)
    {
        echo "<div id='title'><div class='left titlebar'></div><div class='right titlebar'></div><h1>$title</h1></div>";
        echo "<div id='mainpage'>";
    }
    public static function showh3title($title)
    {echo "<h3>$title</h3>";}
    public static function navigationbar()
    {
        ?>
        <nav>
            <div class="left navbar"></div>
            <div class="right navbar"></div>
            <ul>
                <li><a href="members.php?actie=home">Home</a></li>
                <li>
                    <div class="button"></div>
                    <a href="members.php?actie=charsearch">Person Search</a></li>
                <li>
                    <div class="button"></div>
                    <a href="members.php?actie=charsel">Character Editor</a></li>
                <li>
                    <div class="button"></div>
                    <a href="members.php?actie=logout">Log Out</a></li>
            </ul>
        </nav>
        <?php
    }

    public static function characterChooser($characters)
    {
        echo '<div id="characterchooserpage">';
        Output::characterCreateButton();
        echo '
        <div class="charactertable">
        <div class="row" >
            <div class="col-sm-4"><p class="charactertablename">Character name</p></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div>';
        $arrlength = count($characters);
        for ($x = 0; $x < $arrlength; $x++) {
            echo '
                <div class="row">
                    <div class="col-sm-4"><p class="charactertablename">' . $characters[$x]->charactername . '</p></div>
                    <div class="col-sm-4"><a href="?actie=charedit&charid=' . $characters[$x]->characterid . '" class="btn" >Edit</a> </div>
                    <div class="col-sm-4"><a href="?actie=charrem&charid=' . $characters[$x]->characterid . '" class="btn" >Remove</a></div>
                </div>';
        }
        echo '</div>';
        echo '</div>';
    }



    public static function ShowCharacterEditor()
    {
        echo '<form action="members.php?actie=charsel&form=charedit&charid=' . $_GET["charid"] . '" method="post" class="form-group">';
        ?>
        <div class="tabbable boxed parentTabs">
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a data-toggle="pill" href="#crafting">Crafting</a></li>
                <li><a data-toggle="pill" href="#gathering">Gathering</a></li>
                <li><a data-toggle="pill" href="#refining">Refining</a></li>
                <li><a data-toggle="pill" href="#farming">Farming</a></li>
                <li><a data-toggle="pill" href="#equip">Equip</a></li>
            </ul>
            <div class="tab-content">
                <div id="crafting" class="tab-pane fade in active">
                    <?php
                    $craftingtypes = array(
                        "Melee" => array("Battleaxe_Crafter", "Dagger_Crafter", "Hammer_Crafter", "Mace_Crafter", "Quarterstaff_Crafter", "Spear_Crafter", "Sword_Crafter", "DemolitionHammer_Crafter"),
                        "Ranged" => array("Bow_Crafter", "Crossbow_Crafter"),
                        "Magic" => array("Arcane_Staff_Crafter", "Cursed_Staff_Crafter", "Fire_Staff_Crafter", "Frost_Staff_Crafter", "Holy_Staff_Crafter", "Nature_Staff_Crafter"),
                        "Armor" => array("Cloth_Robe_Crafter", "Leather_Jacket_Crafter", "Plate_Armor_Crafter"),
                        "Bag" => array("Bag_Tailor"),
                        "Cape" => array("Cape_Tailor"),
                        "Head" => array("Cloth_Cowl_Crafter", "Leather_Hood_Crafter", "Soldier_Helmet_Crafter"),
                        "Misc" => array("Lumberjack_Crafter", "Quarrier_Crafter", "Skinner_Crafter", "Miner_Crafter", "Harvester_Crafter"),
                        "Offhand" => array("Tome_Crafter", "Shield_Crafter", "Torch_Crafter"),
                        "Shoes" => array("Cloth_Sandals", "Leather_Shoes", "Plate_Boots")
                    );
                    self::createFormofForms($craftingtypes, "crafting");
                    ?>
                </div>
                <div id="gathering" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Fiber", "Hide", "Ore", "Rock", "Wood");
                    self::createForm("gatheringform", $gatheringtypes, "gathering");
                    ?>
                </div>
                <div id="refining" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Cloth", "Leather", "Metal_Bar", "Planks", "Stone_Block");
                    self::createForm("refiningform", $gatheringtypes, "refining");
                    ?>
                </div>
                <div id="farming" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Alchemist", "Animal_Breeder", "Chef", "Crop_Farmer", "Herbalist");
                    self::createFormFarming("farmingform", $gatheringtypes, "farming");
                    ?>
                </div>
                <div id="equip" class="tab-pane fade">
                    <?php
                    $fightingequip = array(
                        "Melee_" => array("Axe_Fighter", "Dagger_Fighter", "Hammer_Fighter", "Mace_Fighter", "Quarterstaff_Fighter", "Spear_Fighter", "Sword_Fighter"),
                        "Ranged_" => array("Bow_Fighter", "Crossbow_Fighter"),
                        "Magic_" => array("Arcanist", "Warlock", "Pyromancer", "Frost_Mage", "Priest", "Nature_Staff_Fighter"),
                        "Armor_" => array("Cloth_Robe_Fighter", "Leather_Jacket_Fighter", "Plate_Armor_Fighter"),
                        "Head_" => array("Cloth_Cowl_Fighter", "Leather_Hood_Fighter", "Plate_Helmet_Fighter"),
                        "Offhand_" => array("Tome_Fighter", "Shield_Fighter", "Torch_Fighter"),
                        "Shoes_" => array("Cloth_Sandals_Fighter", "Leather_Shoes_Fighter", "Plate_Boots_Fighter")
                    );
                    self::createFormofForms($fightingequip, "combat");
                    ?>
                </div>
            </div>
        </div>
        <?php
        echo '<input type="submit" value="Submit" class="form-control" >
        </form>';
    }

    public static function showDataNavigation($active)
    {
        $a = array("", "", "", "", "", "","","");
         $a[$active] = 'class="active"';


        echo '
        <ul class="nav nav-pills nav-justified">
            <li '.$a[0].' ><a href="data.php?actie=members">Members</a></li>
            <li '.$a[1].' ><a href="data.php?actie=stat&tablename=crafting">Crafters</a></li>
            <li '.$a[2].' ><a href="data.php?actie=stat&tablename=gathering">Gatherers</a></li>
            <li '.$a[3].' ><a href="data.php?actie=stat&tablename=refining">Refiners</a></li>
            <li '.$a[4].' ><a href="data.php?actie=stat&tablename=farming">Farmers</a></li>
            <li '.$a[5].' ><a href="data.php?actie=stat&tablename=combat">Player Equipment</a></li>
        </ul>
        ';
    }

    /*
                      _ _                     _
                     | | |                   | |
  ___ _ __ ___   __ _| | |   _ __   __ _ _ __| |_ ___
 / __| '_ ` _ \ / _` | | |  | '_ \ / _` | '__| __/ __|
 \__ \ | | | | | (_| | | |  | |_) | (_| | |  | |_\__ \
 |___/_| |_| |_|\__,_|_|_|  | .__/ \__,_|_|   \__|___/
                            | |
                            |_|
    */
    public static function characterCreateButton()
    {
        ?>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Create Character
        </button>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create new Character</h4>
                    </div>
                    <form action="members.php?actie=charedit&form=createcharacter" method="post">
                        <div class="form-group">
                            <div class="modal-body">
                                <label for="charactername">Name:</label>
                                <input type="text" class="form-control" id="charactername" name="charactername" required="required">
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Create">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <?php
    }
    /*
  _    _        _
 | |  | |      | |
 | |__| |  ___ | | _ __    ___  _ __  ___
 |  __  | / _ \| || '_ \  / _ \| '__|/ __|
 | |  | ||  __/| || |_) ||  __/| |   \__ \
 |_|  |_| \___||_|| .__/  \___||_|   |___/
                  | |
                  |_|
    */
    public static function createFormofForms($values2d, $tablename)
    {
        echo '<div class="tabbable"><ul class="nav nav-tabs nav-justified">';
        foreach ($values2d as $x => $x_value) {
            if ($x == "Melee") {
                echo '<li class="active"><a data-toggle="tab" href="#' . $x . '">' . str_replace('_', ' ', $x) . '</a></li>';
            } else {
                echo '<li><a data-toggle="tab" href="#' . $x . '">' . str_replace('_', ' ', $x) . '</a></li>';
            }
        }
        echo '</ul><div class="tab-content">';
        $i = 0;
        foreach ($values2d as $x => $x_value) {
            if ($i == 0) {
                echo '<div id="' . $x . '" class="tab-pane fade in active">';
                $i++;
            } else {
                echo '<div id="' . $x . '" class="tab-pane fade">';
            }
            self::createForm($x, $x_value, $tablename);
            echo '</div>';
        }
        echo '</div></div>';
    }

    public static function createForm($formname, $values, $tablename)
    {
        echo '<div class="smallform">';
        echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">Achievement </div><div class="col-sm-4 formtiers1">Tier</div></div>';
        $arrlength = count($values);
        $DBtools = DBtools::getdbinstance();
        for ($x = 0; $x < $arrlength; $x++) {
            $selected = $DBtools->getTierFromTabel($tablename, $_GET["charid"], $values[$x]);
            $selectedtier = $selected[0]->tier;
            if (empty($selectedtier)) {
                $selectedtier = 0;
            }
            Output::PlaceLabelAndTierSelect($values[$x], $selectedtier, $tablename);
        }
        echo '</div>';
        $DBtools->closeDB();
    }

    public static function createFormFarming($formname, $values, $tablename)
    {
        echo '<div class="smallform">';
        echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">Achievement </div><div class="col-sm-4 formtiers1">Tier</div></div>';
        $arrlength = count($values);
        $DBtools = DBtools::getdbinstance();
        for ($x = 0; $x < $arrlength; $x++) {
            $selected = $DBtools->getTierFromTabel($tablename, $_GET["charid"], $values[$x]);
            $selectedtier = $selected[0]->tier;
            if (empty($selectedtier)) {
                $selectedtier = 0;
            }
            echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">';
            Output::PlaceLabelFor($values[$x]);
            echo '</div><div class="col-sm-4 formtiers1">';
            echo '<input type="number" class="form-control" id="' . $values[$x] . '" name="' . $tablename . '*' . $values[$x] . '" value="'.$selectedtier.'" >';
            echo '</div></div>';
        }
        echo '</div>';
        $DBtools->closeDB();
    }

    public static function PlaceLabelAndTierSelect($labelname, $selected, $tablename)
    {
        echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">';
        Output::PlaceLabelFor($labelname);
        echo '</div><div class="col-sm-4 formtiers1">';
        Output::PlaceTierSelection($labelname, $selected, $tablename);
        echo '</div></div>';

    }

    public static function PlaceLabelFor($labelname)
    {
        echo "<label for='" . $labelname . "'>" . str_replace('_', ' ', $labelname) . "</label>";
    }

    public static function PlaceTierSelection($name, $selected, $tablename)
    {
        echo '
        <select class="form-control" id="' . $name . '" name="' . $tablename . '*' . $name . '">
			<option value="0">-- Select Tier --</option>
        ';
        for ($i = 3; $i < 9; $i++) {
            echo '<option value="' . $i . '"';
            if ($selected == $i) {
                echo ' selected';
            }
            echo '>Tier ' . $i . '</option>';
        }
        echo '</select>';
    }

    public static function PageEnd()
    {
        ?>
        </div>
        </div>
        <script src="js/main.js"></script>
        </body>
        </html>
        <?php
    }
}