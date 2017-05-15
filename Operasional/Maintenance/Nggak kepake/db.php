<?php
class db{

  private $dbHost="localhost";
  private $dbUser = "root";
  private $dbPassword = "";
  private $dbName = "laporan";

  public function connect(){
    $mysql = new mysql($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
    if(mysqli_connect_errno()){
      printf("koneksi gagal:%s", mysqli_connect_errno());
      exit();
    }else{
      printf("Koneksi berhasil");
    }
  }
}
