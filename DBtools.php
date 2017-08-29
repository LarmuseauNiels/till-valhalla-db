<?php
class DBtools
{
	private static $dbinstance = null;

	private $db;

	private function __construct()
	{
		try
		{
            $server = holder;
            $database = holder;
            $username = holder;
            $password = holder;

            $this->db = new PDO("mysql:host=$server; dbname=$database; charset=utf8mb4",
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
			self::$dbinstance = new db();
		}
		return self::$dbinstance;
	}

	public function closeDB()
	{
		self::$dbinstance = null;
	}
}
