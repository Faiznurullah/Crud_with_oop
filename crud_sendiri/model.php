
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">


<?php

 class database{

//property koneksi database
   private $server = 'localhost',
           $username = 'root',
           $pass    = '',
           $data = 'sendiri',
           $hal = 5,
           $conn;

  //method connect
  public function __construct(){

    $this->conn = mysqli_connect($this->server, $this->username, $this->pass, $this->data) or die ($this->conn);

  }

  public function hal(){
    return $this->hal;
  }




//method insert to database
  public function insert(){

 if(isset($_POST['kirim'])){


  $nama = htmlspecialchars($_POST['nama']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $umur = htmlspecialchars($_POST['umur']);

//ambil data dari DB untuk di cocokan
  $ambil_data = mysqli_query($this->conn, "select * from user where nama='$nama' and alamat='$alamat' and umur='$umur' ");
//pengecekan banyak data
  $cek_jum = mysqli_num_rows($ambil_data);

  //kondisi dimana baranga harus lebih besar > 0
  if($cek_jum > 0){

  $fetch_dat = mysqli_fetch_array($ambil_data);

  $nama === $fetch_dat['nama'];
  $alamat === $fetch_dat['alamat'];
  $umur === $fetch_dat['umur'];

  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
     echo "<div class='alert alert-warning mt-4 ml-5' role='alert'>";
    echo "<p><center>Sudah Terdaftar Sebagai Teman</center></p>";
     echo   "</div>";
     echo "</div>";


  }else{

//untuk menginsert ke database
 $insertt =  "INSERT INTO user VALUES (NULL,'$nama','$alamat','$umur')";

//kondisi insert
 if($sql= $this->conn->query($insertt)){


                                 echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                    echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
                                   echo "<p><center>Menambah Data Sukses</center></p>";
                                    echo   "</div>";
                                    echo "</div>";


 }else{

                                 echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                                   echo "<p><center>Menambah Data Gagal</center></p>";
                                    echo   "</div>";
                                    echo "</div>";

 }

}

 }

  }

//method untuk menampilkan data atau read
  public function tampil(){

//property untuk membatasi
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $this->hal;


    $data = null;

    $query = "SELECT * FROM user limit $start, $this->hal ";
    if ($sql = $this->conn->query($query)) {
      while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
      }
    }
    return $data;
  }


//method untuk menghapus data
  public function delete($id){

    $query = "DELETE FROM user where id = '$id'";
    if ($sql = $this->conn->query($query)) {
      return true;
    }else{
      return false;
    }
  }


  //method melihat secara detail
  public function detail($id){

    $data = null;

    $query = "SELECT * FROM user WHERE id = '$id'";
    if ($sql = $this->conn->query($query)) {
      while ($row = $sql->fetch_assoc()) {
        $data = $row;
      }
    }
    return $data;
  }

//method untuk menampilkan isi di edit
public function edit($id){

  $data = null;

  $query = "SELECT * FROM user WHERE id = '$id'";
  if ($sql = $this->conn->query($query)) {
    while($row = $sql->fetch_assoc()){
      $data = $row;
    }
  }
  return $data;
}




//method mengupdate isi database
public function update($data){

  $query = "UPDATE user SET nama='$data[nama]', alamat='$data[alamat]', umur='$data[umur]' WHERE id='$data[id] '";

  if ($sql = $this->conn->query($query)) {
    return true;
  }else{
    return false;
  }
}


//jumlah teman
public function jum_id(){

   $jum_id =mysqli_query($this->conn, "SELECT COUNT(*) as id from user");
   $row = mysqli_fetch_array($jum_id);
   return $jum = $row['id'];


}




 }

$database = new database;


?>
