<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';
require __DIR__ . '/vendor/autoload.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

$provider = new \Discord\OAuth\Discord([
    'clientId'     => '352090158444838914',
    'clientSecret' => 'UyEUf7Ny2nC7D4Qcpl_6hxf8Fry7vKQq',
    'redirectUri'  => 'http://localhost/till-valhalla-db/',
]);


if (! isset($_GET['code'])) {
    echo '<a href="'.$provider->getAuthorizationUrl().'">Login with Discord</a>';
} else {


    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);

    // Get the user object.
    $user = $provider->getResourceOwner($token);

    // Get the guilds and connections.
    $guilds = $user->guilds;
    $connections = $user->connections;

    // Accept an invite
    $invite = $user->acceptInvite('https://discord.gg/0SBTUU1wZTUo9F8v');


    // Store the new token.
    var_dump($user);
    var_dump($guilds);
}



/*
if(!isset($userid))
{
    //not authenticated
    Output::showtitle("Log in with discord");
    Output::showdiscordauthentication();

    $actie = isset($_GET["actie"])? $_GET["actie"] : "";

}
else
{
    //authenticated
    header("Location: members.php");
}
*/
require_once 'HTMLtail.php';