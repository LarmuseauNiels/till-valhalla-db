<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';
require __DIR__ . '/vendor/autoload.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();
$configs = include('config.php');

$provider = new \Discord\OAuth\Discord([
    'clientId'     => $configs[clientId],
    'clientSecret' => $configs[clientSecret],
    'redirectUri'  => $configs[redirectUri],
]);

if(!isset($userid))
{
    if (! isset($_GET['code'])) {
        header("Location: ".$provider->getAuthorizationUrl());
        //echo '<a href="'.$provider->getAuthorizationUrl().'">Login with Discord</a>';
    } else {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);
        // Get the user object.
        $user = $provider->getResourceOwner($token);
        // Get the guilds and connections.
        $guilds = $user->guilds;
        $authenticator->login($user);
        header("Location: index.php");
    }
}
else
{
    //authenticated
    header("Location: members.php");
}

require_once 'HTMLtail.php';