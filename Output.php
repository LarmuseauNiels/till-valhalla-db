<?php

class Output
{
    public static function showtitle($title)
    {
        echo "<div id='title'><div class='left titlebar'></div><div class='right titlebar'></div><h1>$title</h1></div>";
        echo "<div id='mainpage'>";
    }

    public static function showh3title($title)
    {
        echo "<h3>$title</h3>";
    }

    public static function navigationbar()
    {
        ?>
        <nav>
            <div class="left navbar"></div>
            <div class="right navbar"></div>
            <ul>
                <li><a href="?actie=home">Home</a></li>
                <li><div class="button"></div> <a href="?actie=charsearch">Person Search</a></li>
                <li> <div class="button"></div><a href="?actie=charedit">Character Editor</a></li>
                <li> <div class="button"></div><a href="?actie=logout">Log Out</a></li>
            </ul>

        </nav>
        <?php
    }

    public static function ShowCharacterEditor()
    {
        ?><div class="tabbable boxed parentTabs" >
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
                    "Melee"=>array("Battleaxe_Crafter", "Dagger_Crafter", "Hammer_Crafter", "Mace_Crafter", "Quarterstaff_Crafter", "Spear_Crafter", "Sword_Crafter", "DemolitionHammer_Crafter"),
                    "Ranged"=>array("Bow_Crafter", "Crossbow_Crafter"),
                    "Magic"=>array("Arcane_Staff_Crafter", "Cursed_Staff_Crafter", "Fire_Staff_Crafter", "Frost_Staff_Crafter", "Holy_Staff_Crafter", "Nature_Staff_Crafter"),
                    "Armor"=>array("Cloth_Robe_Crafter", "Leather_Jacket_Crafter", "Plate_Armor_Crafter"),
                    "Bag"=>array("Bag_Tailor"),
                    "Cape"=>array("Cape_Tailor"),
                    "Head"=>array("Cloth_Cowl_Crafter", "Leather_Hood_Crafter", "Soldier_Helmet_Crafter"),
                    "Misc"=>array("Lumberjack_Crafter", "Quarrier_Crafter", "Skinner_Crafter", "Miner_Crafter", "Harvester_Crafter"),
                    "Offhand"=>array("Tome_Crafter", "Shield_Crafter", "Torch_Crafter"),
                    "Shoes"=>array("Cloth_Sandals", "Leather_Shoes", "Plate_Boots")
                    );
                    self::createFormofForms($craftingtypes);
                    ?>
                </div>
                <div id="gathering" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Fiber", "Hide", "Ore", "Rock", "Wood");
                    self::createForm("gatheringform",$gatheringtypes);
                    ?>
                </div>
                <div id="refining" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Cloth", "Leather", "Metal_Bar", "Planks", "Stone_Block");
                    self::createForm("refiningform",$gatheringtypes);
                    ?>
                </div>
                <div id="farming" class="tab-pane fade">
                    <?php
                    $gatheringtypes = array("Alchemist", "Animal_Breeder", "Chef", "Crop_Farmer", "Herbalist");
                    self::createForm("showfarmingform",$gatheringtypes);
                    ?>
                </div>
                <div id="equip" class="tab-pane fade">
                    <?php
                    $craftingtypes = array(
                    "Melee_"=>array("Axe_Fighter", "Dagger_Fighter", "Hammer_Fighter", "Mace_Fighter", "Quarterstaff_Fighter", "Spear_Fighter", "Sword_Fighter"),
                    "Ranged_"=>array("Bow_Fighter", "Crossbow_Fighter"),
                    "Magic_"=>array("Arcanist", "Warlock", "Pyromancer", "Frost_Mage", "Priest", "Nature_Staff_Fighter"),
                    "Armor_"=>array("Cloth_Robe_Fighter", "Leather_Jacket_Fighter", "Plate_Armor_Fighter"),
                    "Head_"=>array("Cloth_Cowl_Fighter", "Leather_Hood_Fighter", "Plate_Helmet_Fighter"),
                    "Offhand_"=>array("Tome_Fighter", "Shield_Fighter", "Torch_Fighter"),
                    "Shoes_"=>array("Cloth_Sandals_Fighter", "Leather_Shoes_Fighter", "Plate_Boots_Fighter")
                    );
                    self::createFormofForms($craftingtypes);
                    ?>
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
    public static function createFormofForms($values2d)
    {
        echo '<div class="tabbable"><ul class="nav nav-tabs nav-justified">';
        foreach($values2d as $x => $x_value) {
            if ($x =="Melee"){echo '<li class="active"><a data-toggle="tab" href="#'.$x.'">'.str_replace('_', ' ', $x).'</a></li>';}
            else{echo '<li><a data-toggle="tab" href="#'.$x.'">'.str_replace('_', ' ', $x).'</a></li>';}
        }
        echo '</ul><div class="tab-content">';
        $i = 0;
        foreach($values2d as $x => $x_value) {
            if ($i ==0){echo '<div id="'.$x.'" class="tab-pane fade in active">'; $i++;}
            else{echo '<div id="'.$x.'" class="tab-pane fade">';}
            self::createForm($x,$x_value);
            echo '</div>';
        }
        echo '</div></div>';
    }

    public static function createForm($formname,$values)
    {
        echo '<form action="" class="form-group smallform">';
        echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">Achievement </div><div class="col-sm-4 formtiers1">Tier</div></div>';
        $arrlength = count($values);
        for($x = 0; $x < $arrlength; $x++) {
            Output::PlaceLabelAndTierSelect($values[$x],0);
        }
        echo '</form>';
    }
    public static function PlaceLabelAndTierSelect($labelname,$selected){
        echo '<div class="row smallformrow"><div class="col-sm-8 formlabels1">';Output::PlaceLabelFor($labelname);echo '</div><div class="col-sm-4 formtiers1">';Output::PlaceTierSelection($labelname,$selected);echo '</div></div>';

    }
    public static function PlaceLabelFor($labelname)
    {
        echo "<label for='".$labelname."'>".str_replace('_', ' ', $labelname)."</label>";
    }
    public static function PlaceTierSelection($name,$selected)
    {
        echo '
        <select class="form-control" id="'.$name.'" name="'.$name.'">
			<option value="">-- Select Tier --</option>
        ';
        for( $i = 3; $i<9; $i++ ) {
            echo '<option value="'.$i.'"';
            if ($selected == $i){echo 'selected';}
            echo '>Tier '.$i.'</option>';
        }
        echo '</select>';
    }
    public static function PageEnd()
    {
?>      </div>
        </div>
        <script src="js/main.js"></script>
        </body>
        </html>
        <?php
    }
}