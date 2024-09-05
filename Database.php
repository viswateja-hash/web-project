<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function disconnect() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function insertContact($name, $email, $number, $date, $address, $plan, $message, $photo) {
        $stmt = $this->conn->prepare("INSERT INTO `contact`(`name`, `email`, `number`, `date`, `address`, `plan`, `message`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssss', $name, $email, $number, $date, $address, $plan, $message, $photo);
        $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $userId;
    }

    public function insertMenu($userId, $items, $categories, $quantities, $numGuests) {
            $stmt = $this->conn->prepare("INSERT INTO `menu`(`userid`, `mitem`, `mcat`, `mqua`, `mper`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('issii', $userId, $items, $categories, $quantities, $numGuests);
            $stmt->execute();
            $stmt->close();
        }

    

    public function insertEvent($userId, $name, $date, $startTime, $endTime, $location, $keyActivities) {
        $stmt = $this->conn->prepare("INSERT INTO `event`(`userid`, `ename`, `edate`, `starttime`, `endtime`, `location`, `keyact`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssss', $userId, $name, $date, $startTime, $endTime, $location, $keyActivities);
        $stmt->execute();
        $stmt->close();
    }
}
?>
