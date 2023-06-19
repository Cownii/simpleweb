<?php
    Class Connect{
        public $sever;
        public $user;
        public $password;
        public $dbName;
        public function __construct()
        {
            $this->sever = "nnsgluut5mye50or.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
            $this->user = "	qz45sv3zumlj3of4";
            $this->password = "e8ykhy8ixx7epfz6";
            $this->dbName = "jvn4u2k6rbiuz1zk";
        }
        //  option 1:  mysqli
        function connectToMySQL():mysqli
        {
            $conn_my = new mysqli($this->sever,$this->user,$this->password,$this->dbName);
            if($conn_my->connect_error)
            {
                die("Failed".$conn_my->connect_error);
            }else{
                // echo "Connect from mysqli sucessful";
            }
            return $conn_my;
        }

        function connectToPDO():PDO{
            try
            {
                $conn_pdo = new PDO
                ("mysql:host=$this->sever;dbname=$this->dbName",$this->user,$this->password);
                // echo "Connect from PDO";
            }
            catch(PDOException $e)
            {
                die("False $e");
            }
            return $conn_pdo;
        }
    }

    // $c = new Connect();
    // $c->connectToMySQL();
    // // echo "<br>";
    // $pdo = new Connect();
    // $pdo->connectToPDO();
    
?>