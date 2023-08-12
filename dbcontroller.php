<?php
class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "assignment";
    private $conn;

    function __construct()
    {
        $attr = "mysql:host=" . $this->host . ";dbname=" . $this->database;
        $opts =
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
        $this->conn = new PDO($attr, $this->user, $this->password, $opts);
    }

    function runQuery($query)
    {
        $result = $this->conn->query($query);
        while ($row = $result->fetch()) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function numRows($query)
    {
        $result = $this->conn->query($query);
        $rowcount = $result->rowCount();
        return $rowcount;
    }
}

?>

<!-- class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "demo";
	private $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}
} -->