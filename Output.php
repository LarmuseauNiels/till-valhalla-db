<?php

class Output
{
    public static function showtitle($title)
    {
        echo "<div id='title'><div class='left titlebar'></div><div class='right titlebar'></div><h1>$title</h1></div>";
        echo "<div id='mainpage'><p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>";
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

    public static function createCharacter()
    {
        ?>
        <form action="">
            <input type="text" id="charactername" name="" >
            <label for="charactername">charactername</label>
            <input type="submit">
        </form>
        <?php
    }



}

