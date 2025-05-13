<?php
 
  // Check If form submitted, insert form data into users table.
  if(isset($_POST['submit'])) {
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $mobile = $_POST['hp'];
    $date = $_POST['tanggal'];
    $departemen = $_POST['departemen'];
    $doctor = $_POST['doctor'];
    $keluhan = $_POST['keluhan'];
    
    // include database connection file
    include_once("config/db.php");
        
    // Insert user data into table
    $result = mysqli_query($mysqli, "INSERT INTO reservasi(nama,email,hp,tanggal,departemen,doctor,keluhan) VALUES('$name','$email','$mobile', $date, $departemen, $doctor, $keluhan)");
    
    // Show message when user added
    echo "User added successfully. <a href='index.php'>View Users</a>";
  }
  ?>