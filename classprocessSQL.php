<?php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'db_tournew';
class Process{
    public function connectDb() {
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
        }

        return $connection;
    }
    public function closeDb($connection = null) {
        mysqli_close($connection);
    }
    public function getUser($idUser){
        $connection = $this->connectDb();
        $querySelect = "SELECT * FROM tb_user WHERE id_user={$idUser}";
        $results = mysqli_query($connection, $querySelect);
        $nvArr = [];
        if (mysqli_num_rows($results) > 0) {
            $bds = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $userArr = $bds[0];
        }
        $this->closeDb($connection);

        return $userArr;
    }
}
?>