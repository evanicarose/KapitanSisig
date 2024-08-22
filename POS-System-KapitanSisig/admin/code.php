<?php

include('../config/function.php');

// Save Admin Functionality
if (isset($_POST['saveAdmin'])) {
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Determine position based on checkbox
    $position = isset($_POST['position']) && $_POST['position'] == 1 ? 1 : 0;

    if ($firstname != '' && $lastname != '' && $username != '' && $password != '') {
        $usernameCheck = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
        if ($usernameCheck && mysqli_num_rows($usernameCheck) > 0) {
            redirect('admins-create.php', 'Username already used by another user.');
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $bcrypt_password,
            'position' => $position // Store the position
        ];

        $result = insert('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin created.');
        } else {
            redirect('admins-create.php', 'Something went wrong.');
        }
    } else {
        redirect('admins-create.php', 'Please fill required fields.');
    }
}

// Update Admin Functionality
if (isset($_POST['updateAdmin'])) {
    $adminId = validate($_POST['adminId']);

    $adminData = getByID('admins', $adminId);

    if ($adminData['status'] != 200) {
        redirect('admins-edit.php?id='.$adminId, 'Admin not found.');
    }

    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Determine position based on checkbox
    $position = isset($_POST['position']) && $_POST['position'] == 1 ? 1 : 0;

    // Check if password needs to be updated
    if ($password != '') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $adminData['data']['password'];
    }

    if ($firstname != '' && $lastname != '' && $username != '') {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $hashedPassword,
            'position' => $position // Update the position
        ];

        $result = update('admins', $adminId, $data);
        if ($result) {
            redirect('admins-edit.php?id='.$adminId, 'Admin updated.');
        } else {
            redirect('admins-edit.php?id='.$adminId, 'Something went wrong.');
        }
    } else {
        redirect('admins-edit.php?id='.$adminId, 'Please fill required fields.');
    }
}

// Save Supplier
if (isset($_POST['saveSupplier'])) {
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $phonenumber = validate($_POST['phonenumber']);
    $address = validate($_POST['address']);

    if ($firstname != '' && $lastname != '' && $phonenumber != '' && $address != '') {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenumber' => $phonenumber,
            'address' => $address
        ];

        $result = insert('suppliers', $data);
        if ($result) {
            redirect('suppliers.php', 'Supplier added successfully.');
        } else {
            redirect('suppliers-create.php', 'Something went wrong.');
        }
    } else {
        redirect('suppliers-create.php', 'Please fill required fields.');
    }
}

// Update Supplier
if (isset($_POST['updateSupplier'])) {
    $supplierId = validate($_POST['supplierId']);

    $supplierData = getById('suppliers', $supplierId);

    if ($supplierData['status'] != 200) {
        redirect('suppliers-edit.php?id=' . $supplierId, 'Invalid Supplier ID.');
    }

    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $phonenumber = validate($_POST['phonenumber']);
    $address = validate($_POST['address']);

    if ($firstname != '' && $lastname != '' && $phonenumber != '' && $address != '') {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenumber' => $phonenumber,
            'address' => $address
        ];

        $result = update('suppliers', $supplierId, $data);
        if ($result) {
            redirect('suppliers-edit.php?id=' . $supplierId, 'Supplier updated successfully.');
        } else {
            redirect('suppliers-edit.php?id=' . $supplierId, 'Something went wrong.');
        }
    } else {
        redirect('suppliers-edit.php?id=' . $supplierId, 'Please fill required fields.');
    }
}


?>
