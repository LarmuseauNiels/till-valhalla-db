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


    public static function showdiscordauthentication()
    {
        ?>
        <ul>
            <li><a href="">log in with discord</a></li>
        </ul>
        <hr />
        <?php
    }

}

