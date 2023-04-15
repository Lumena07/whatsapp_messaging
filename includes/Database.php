<?php 
define('HOST','localhost');
define('USER_NAME','root');
define('PASSWORD','');
define('DB_NAME','movie_database');
// start db class 
class Database{
    private $connection;
    //constructor
    public function __construct(){
        $this->open_db_connection();
    }
    //creating connection with the database
     public function open_db_connection(){
        $this->connection = mysqli_connect(HOST,USER_NAME,PASSWORD,DB_NAME);
        if (mysqli_connect_error()){
            die('Connection Error :' . mysqli_connect_error());
        }

    }
    //Evaluating SQL Query
    public  function query ($sql){
        $result=$this->connection->query($sql);

        if(!$result){
            die('Query fails :' . $sql);
        }
        return $result;
    }
    // Fetching list of data from the SQL Query result
    public function fetch_array($result){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $result_array[]=$row;
            }
            return $result_array;
        }
    }
    //Fetching a single row of data from the SQL Query
     public function fetch_row($result){
        if ($result->num_rows>0){
            return $result->fetch_assoc();
        }
    }
    //check proper format of data
     public function escape_value($value){
        return $this->connection->real_escape_string($value);
    }
    public function insert_id() {
        return mysqli_insert_id($this->connection);
    }
    //This closes connection with SQL
    public function close_connection(){
       $this->connection->close();
    }
}
$database=new Database();

?>
