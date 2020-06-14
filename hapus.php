<?php
    require('connect_database.php');
    //jika benar mendapatkan GET id dari URL
    if(isset($_GET['id'])){
        //membuat variabel $id yang menyimpan nilai dari $_GET['id']
        $email = $_GET['id'];
        
        //melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
        $query = "DELETE FROM users WHERE email=:email";
        $stmt = $db->prepare($query);
        $param = array(
            ":email" => $email
        );
        $stmt->execute($param);
        $user = $stmt->rowcount();
        if ($user == 1){
            echo '<script>alert("Berhasil menghapus data."); document.location="admin.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); document.location="admin.php";</script>';
        }
    }else{
        echo '<script>alert("Data tidak ditemukan di database."); document.location="admin.php";</script>';
    }
?>