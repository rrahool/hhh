<?php
namespace appoindar;

class DatabaseClass
{
    public $hostname = 'localhost';
    //public $username='nohassle_mahbub';
    //public $password='&Pa%3+wN0^#F';
    public $username='root';
    public $password='';
    public $dbname='lions';
    public $conn;

    public function __construct()
    {
        try {
                $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname, 3306);
        } catch (PDOException $e) {
                echo $e->getmessage();
        }
    }

    public function edit($id) {
        $data = null;

        $query = "SELECT * FROM user_details WHERE id = '$id'";

        if($sql = $this->conn->query($query)) {
            while($row = $sql->fetch_assoc()){
                $data = $row;
            }
            return $data; 
        }
    }

    public function update($data){
        $query = "UPDATE user_details SET fname='$data[fname]', 
                                        mname='$data[mname]', 
                                        lname='$data[lname]', 
                                        gender='$data[gender]', 
                                        dob='$data[dob]', 
                                        doj='$data[doj]', 
                                        occupation='$data[occupation]', 
                                        degree='$data[degree]', 
                                        designation='$data[designation]', 
                                        srvc_yr='$data[srvc_yr]', 
                                        business_type='$data[business_type]', 
                                        address='$data[address]', 
                                        address2='$data[address2]', 
                                        city='$data[city]', 
                                        state='$data[state]', 
                                        zip='$data[zip]', 
                                        country='$data[country]', 
                                        interest='$data[interest]', 
                                        user_code='$data[user_code]' WHERE id='$data[id]'";

        if($sql = $this->conn->query($query)) {
            return true; 
        } else {
            return false;
        }
    }
}
