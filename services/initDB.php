<?php 
class InitDB{
	private $pdo;
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$dbName = "bincom_test";
		$password = "";
		try {
			$dsn = "mysql:host=".$servername.";dbname=".$dbName;
			$this->pdo = new PDO($dsn, $username, $password);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->pdo;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function run($sql, $args = NULL)
    {
        $stmt=null;
        
            if (!$args)
        {
            return $this->pdo->query($sql);
        }
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($args);
        } catch (PDOException $e) {
            //SEND THIS TO AUDIT SERVICE FOR LOGGING
            echo $e->getMessage();
        }
        
        return $stmt;
    }
}