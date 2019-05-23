<?PHP
Class dbObj{
    /* Database connection start */
    var $dbhost = "localhost";
    var $username = "u158189477_ydun";
    var $password = "root123";
    var $dbname = "u158189477_ydun";
    var $conn;
    function getConnstring() {
        $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
        
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }
}
?>