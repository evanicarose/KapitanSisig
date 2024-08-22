<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Suppliers
                <a href="suppliers-create.php" class= "btn btn-primary float-end">Add Supplier</a>
            </h4>
        </div>
        <div class="card-body">
            <?php  alertMessage(); ?>

            <?php 
                        $suppliers = getAll('suppliers');
                        if(mysqli_num_rows($suppliers) > 0)
                        {

                        ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($suppliers as $suppliersItem) : ?>
                    <tr>
                        <td><?= $suppliersItem['id'] ?></td>
                        <td><?= $suppliersItem['firstname'] ?></td>
                        <td><?= $suppliersItem['lastname'] ?></td>
                        <td><?= $suppliersItem['phonenumber'] ?></td>
                        <td><?= $suppliersItem['address']?></td>
                        <td>
                            <a href="suppliers-edit.php?id=<?= $suppliersItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="suppliers-delete.php?id=<?= $suppliersItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

                </table>
            </div>
            <?php 
                         }
                         else{
                            ?>
                            <tr>
                            <td class="mb-0">No Record Found</td>
                        </tr>
                        <?php
                         }
                        ?>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>