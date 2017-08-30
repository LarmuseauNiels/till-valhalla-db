<?php
class DBtools
{
	private static $dbinstance = null;

	private $DBtools;

	private function __construct()
	{
		try
		{
            $server = "larmuseakzniels.mysql.db";
            $database = "larmuseakzniels";
            $username = "larmuseakzniels";
            $password = "937yhGnuO3hf";

            $this->DBtools = new PDO("mysql:host=$server; dbname=$database; charset=utf8mb4",
                $username,
                $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public static function getdbinstance()
	{
		if(is_null(self::$dbinstance))
		{
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
        try
        {
            $sql = "SELECT * FROM members
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $user;
    }

	public function doesUserExist($userid)
    {
        $user = $this->getUserFromID($userid);
        return (!empty($user) ? true : false);
    }

    public function addUser($userid,$username,$discriminator,$lastlogin)
    {
        try
        {
            $sql = "INSERT INTO members(userid,username,discriminator,lastlogin)
						VALUES(:userid, :username,:discriminator,:lastlogin)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":discriminator", $discriminator);
            $stmt->bindParam(":lastlogin", $lastlogin);
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function updateUser($userid,$username,$discriminator,$lastlogin)
    {
        try
        {
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
        }
        catch (PDOException $e)
		{
            die($e->getMessage());
        }
    }

    public function getTabel($tabel)
    {
        try
        {
            switch ($tabel)
            {
                case "crafting": $sql = "SELECT * FROM crafting";
                    break;
                case "farming": $sql = "SELECT * FROM farming";
                    break;
                case "refining": $sql = "SELECT * FROM refining";
                    break;
                case "gathering": $sql = "SELECT * FROM gathering";
                    break;

                default: die("Invalled tabelname");
            }

            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $result;
    }

    public function addToTabel($tabel,$characterid,$categoriser ,$tier)
    {
        try
        {
            switch ($tabel)
            {
                case "crafting": $sql = "INSERT INTO crafting(characterid,craftingbranch,tier)
						VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "farming": $sql = "INSERT INTO farming(characterid,farmbranch,tier)
						VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "refining": $sql = "INSERT INTO refining(characterid,resource,tier)
						VALUES(:characterid, :categoriser,:tier)";
                    break;
                case "gathering": $sql = "INSERT INTO gathering(characterid,profession,tier)
						VALUES(:characterid, :categoriser,:tier)";
                    break;
                default: die("Invalid table name");
            }
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid);
            $stmt->bindParam(":categoriser", $categoriser);
            $stmt->bindParam(":tier", $tier);
            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function createCharacter($userid ,$charactername)
    {
        try
        {
            $sql = "INSERT INTO character (userid,charactername)
						VALUES(:userid, :charactername)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":charactername", $charactername);
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function getUserCharacters($userid)
    {
        try
        {
            $sql = "SELECT * FROM character
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $characters = $stmt->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $characters;
    }

    public function getUserFromCharacters($characterid)
    {
        try
        {
            $sql = "SELECT * FROM character
					WHERE characterid = :characterid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":characterid", $characterid);
            $stmt->execute();
            $characters = $stmt->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
        return $characters;
    }

}

