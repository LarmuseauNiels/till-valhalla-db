<?php

class DBtools
{
    private static $dbinstance = null;
    private $DBtools;

    private function __construct()
    {
        try {
            $configs = include('config.php');
            $this->DBtools = new PDO("mysql:host=$configs[server]; dbname=$configs[database]; charset=utf8mb4",
                $configs[username],
                $configs[password],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getdbinstance()
    {
        if (is_null(self::$dbinstance)) {
            self::$dbinstance = new DBtools();
        }
        return self::$dbinstance;
    }

    public function closeDB()
    {
        self::$dbinstance = null;
    }

    public function getUserFromID($userid)
    {
        try {
            $sql = "SELECT * FROM members
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid, \PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $user;
    }

    public function getMembers()
    {
        try {
            $sql = "SELECT * FROM members";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }


    public function doesUserExist($userid)
    {
        $user = $this->getUserFromID($userid);
        return (!empty($user) ? true : false);
    }

    public function checkcharid($charid, $userid)
    {
        $characters = $this->getUserCharacters($userid);
        $arrlength = count($characters);
        $result = false;
        for ($x = 0; $x < $arrlength; $x++) {
            if ($characters[$x]->characterid == $charid) {
                $result = true;
            }
        }
        return $result;
    }

    public function addUser($userid, $username, $discriminator, $lastlogin)
    {
        try {
            $sql = "INSERT INTO members(userid,username,discriminator,lastlogin)
						VALUES(:userid, :username,:discriminator,:lastlogin)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":discriminator", $discriminator);
            $stmt->bindParam(":lastlogin", $lastlogin);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function updateUser($userid, $username, $discriminator, $lastlogin)
    {
        try {
            $sql = "UPDATE members
							SET username = :username,
								discriminator = :discriminator,
								lastlogin = :lastlogin
							WHERE userid = :userid   ";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":discriminator", $discriminator);
            $stmt->bindParam(":lastlogin", $lastlogin);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getTabel($tabel)
    {
        try {
            switch ($tabel) {
                case "crafting":
                    $sql = "SELECT * FROM crafting";
                    break;
                case "farming":
                    $sql = "SELECT * FROM farming";
                    break;
                case "refining":
                    $sql = "SELECT * FROM refining";
                    break;
                case "gathering":
                    $sql = "SELECT * FROM gathering";
                    break;
                case "combat":
                    $sql = "SELECT * FROM combat";
                    break;
                default:
                    die("Invalled tabelname 2001");
            }

            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $result;
    }

    public function getTierFromTabel($tabel, $characterid, $categoriser)
    {
        try {
            switch ($tabel) {
                case "crafting":
                    $sql = "SELECT * FROM `crafting` WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "farming":
                    $sql = "SELECT * FROM `farming` WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "refining":
                    $sql = "SELECT * FROM `refining` WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "gathering":
                    $sql = "SELECT * FROM `gathering` WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "combat":
                    $sql = "SELECT * FROM `combat` WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                default:
                    die("Invalled tabelname 2002");
            }
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid, \PDO::PARAM_INT);
            $stmt->bindParam(":categoriser", $categoriser, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }


    public function addToTabel($tabel, $characterid, $categoriser, $tier)
    {
        try {
            switch ($tabel) {
                case "crafting":
                    $sql = "INSERT INTO `crafting`(`characterid`,`categoriser`,`tier`) VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "farming":
                    $sql = "INSERT INTO `farming`(`characterid`,`categoriser`,`tier`) VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "refining":
                    $sql = "INSERT INTO `refining`(`characterid`,`categoriser`,`tier`) VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "gathering":
                    $sql = "INSERT INTO `gathering`(`characterid`,`categoriser`,`tier`) VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "combat":
                    $sql = "INSERT INTO `combat`(`characterid`,`categoriser`,`tier`) VALUES(:characterid, :categoriser,:tier)";
                    break;
                default:
                    die("Invalid table name 2003");
            }
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid, \PDO::PARAM_INT);
            $stmt->bindParam(":categoriser", $categoriser, \PDO::PARAM_STR);
            $stmt->bindParam(":tier", $tier, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function updateToTabel($tabel, $characterid, $categoriser, $tier)
    {
        try {
            switch ($tabel) {
                case "crafting":
                    $sql = "UPDATE `crafting` SET `tier` = :tier WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "farming":
                    $sql = "UPDATE `farming` SET `tier` = :tier WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "refining":
                    $sql = "UPDATE `refining` SET `tier` = :tier WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "gathering":
                    $sql = "UPDATE `gathering` SET `tier` = :tier WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                case "combat":
                    $sql = "UPDATE `combat` SET `tier` = :tier WHERE `characterid` = :characterid AND `categoriser` = :categoriser";
                    break;
                default:
                    die("Invalid table name 2004");
            }
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid, \PDO::PARAM_INT);
            $stmt->bindParam(":categoriser", $categoriser, \PDO::PARAM_STR);
            $stmt->bindParam(":tier", $tier, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function doesTableIntryExist($tabel, $characterid, $categoriser)
    {
        $tier = $this->getTierFromTabel($tabel, $characterid, $categoriser);
        return (!empty($tier) ? true : false);
    }

    public function createCharacter($userid, $charactername)
    {
        try {
            $sql = "INSERT INTO `character`(`userid`, `charactername`) VALUES (:userid,:charactername)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid, \PDO::PARAM_INT);
            $stmt->bindParam(":charactername", $charactername, \PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function removeCharacter($characterid)
    {
        try {
            $sql = "DELETE FROM `character` WHERE `characterid` = :characterid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getUserCharacters($userid)
    {
        try {
            $sql = "SELECT * FROM `character` WHERE `userid` = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid, \PDO::PARAM_INT);
            $stmt->execute();
            $characters = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $characters;
    }

    public function getUserFromCharacters($characterid)
    {
        try {
            $sql = "SELECT * FROM `character` WHERE `characterid` = :characterid ";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid, \PDO::PARAM_INT);
            $stmt->execute();
            $characters = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $characters;
    }
}
