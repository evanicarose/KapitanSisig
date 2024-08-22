<?php

require '../config/function.php';

// Check if 'id' parameter is set and is numeric
$paraResult = checkParam('id');
if (is_numeric($paraResult)) {
    $supplierId = validate($paraResult);

    // Fetch supplier data
    $supplier = getById('suppliers', $supplierId);

    if ($supplier['status'] == 200) {
        // Delete the supplier
        $supplierDeleteRes = delete('suppliers', $supplierId);
        if ($supplierDeleteRes) {
            redirect('suppliers.php', 'Supplier Deleted.');
        } else {
            redirect('suppliers.php', 'Something Went Wrong!');
        }
    } else {
        redirect('suppliers.php', $supplier['message']);
    }
} else {
    redirect('suppliers.php', 'Invalid ID.');
}
?>
