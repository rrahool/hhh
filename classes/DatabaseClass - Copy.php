<?php
namespace appoindar;

class DatabaseClass
{
    public $hostname = 'localhost';
    public $username='goalsnoh_mahbub';
    public $password='N3t@canada';
    public $dbname='goalsnoh_calendar';
    public $conn;

    public function __construct()
    {
        try {
                $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname, 3306);
        } catch (PDOException $e) {
                echo $e->getmessage();
        }
    }
}
