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

    public function getUsername($userid)
    {

    }

}
