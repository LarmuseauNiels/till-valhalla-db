<?php

class Output
{
    public static function showtitle($title)
    {
        echo "<h1>$title</h1>";
    }

    public static function showh3title($title)
    {
        echo "<h3>$title</h3>";
    }

    public static function navigationbar()
    {
        ?>
        <nav>
            <ul>
                <li><a href="?actie=home">home</a></li>
                <li><a href="?actie=charsearch">person search</a></li>
                <li><a href="?actie=charedit">character editor</a></li>
                <li><a href="?actie=logout">log out</a></li>
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

