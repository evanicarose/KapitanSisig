<?php

require '../config/function.php';

$paraResult = checkParam('id');
if(is_numeric($paraResult)){
    $adminId = validate($paraResult);
    
    $admin = getById('admins', $adminId);
    if($admin['status']== 200){
        $adminDeleteRes = delete('admins', $adminId);
        if($adminDeleteRes){
            redirect ('admins.php', 'Admin Deleted.');
        }else{
            redirect ('admins.php', 'Something Went Wrong!');
        }
    }else{
        redirect ('admins.php', $admin['message']);
    }
}else{
    redirect ('admins.php', 'Something Went Wrong!');
}
?>