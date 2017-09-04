# Till Valhalla DB

Web platform for managing guild member data from Till Valhalla guild in Albion online

## Installing

### Prerequisites

* PHP webserver
* Oauth Discord application
* valid SSL encryption
* mySQL database


### Installing

Create mySQL database in correct format

![database image](https://d3vv6lp55qjaqc.cloudfront.net/items/0A3k132t1S2X1p3m340B/Image%202017-09-04%20at%205.51.41%20PM.png?X-CloudApp-Visitor-Id=2299709&v=8ce90320)


Make config.php file:
```
<?php
return array(
    'server' => 'hostname',
    'database' => 'databasename',
    'username' => 'username',
    'password' => 'password',
    'clientId'     => 'discord clientid from discord app',
    'clientSecret' => 'discord secret from app',
    'redirectUri'  => 'refer to your index.php file',
);
```

## To Do

* JSON based webapi for quering db
* etc

## Deployed

* Safe Discord authentication(registering and logging into same ID)
* Character Creation (create character linked to account)
* Character editor (add database entries linked to character tracking character stats)
* Responsive editor (character editor reads previous entries and displays correctly)

## Built With

* [jQuery ](https://jquery.com/) - JavaScript Libary
* [Bootstrap](http://getbootstrap.com/) - front-end component library
* [oauth2-discord](https://github.com/teamreflex/oauth2-discord) - Used to create discord authentication

## Authors

* **niels2398** - *Initial work* -

## Acknowledgments

* Booza
* BadZealot (mySQL)
* etc
