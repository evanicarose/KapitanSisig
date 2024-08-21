<?php

include('../config/function.php');

if(isset($_POST['saveAdmin'])){
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $is_banned = isset($_POST['is_banned']) == true ? 1:0;

    if($firstname != '' && $lastname != '' && $username != '' && $password != ''){

        $usernameCheck = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
        if($usernameCheck){
            if(mysqli_num_rows($usernameCheck) > 0){
                redirect('admins-create.php', 'Username Already used by another user.');
            }
        }

        $bcrypt_passwod = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $bcrypt_passwod,
            'is_banned' => $is_banned
            				
        ];

        $result = insert('admins',$data);
        if($result){
            redirect('admins.php', 'Admin created.');
        }else{
            redirect('admins-create.php', 'Something went wrong.');
        }

    }else{
        redirect('admins-create.php', 'Please fill required fields.');
    }
}

if(isset($_POST['updateAdmin'])){
    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);

    if($adminData['status'] != 200){
        redirect('admins-edit.php?=id'.$adminId, 'Please fill required fields.');
    }
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $is_banned = isset($_POST['is_banned']) == true ? 1:0;

    if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData ['data']['password'];
    }

    if($firstname != '' && $lastname != '' && $username != ''){
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $hashedPassword,
            'is_banned' => $is_banned
            				
        ];

        $result = update('admins',$adminId, $data);
        if($result){
            redirect('admins-edit.php?id='.$adminId, 'Admin updated.');
        }else{
            redirect('admins-edit.php?id='.$adminId, 'Something went wrong.');
        }
    }else{
        redirect('admins-create.php', 'Please fill required fields.');
    }
}



?>