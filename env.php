<?php
class env {
    public function connectdb()
    {
        $host = "localhost";
        $username_db = "root";
        $pass_db = "";
        $name_db = "portofolio";
        $con = new mysqli($host,$username_db,$pass_db,$name_db);
        return $con;
    }
}
?>