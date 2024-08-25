<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Units
                <a href="units-create.php" class = "btn btn-primary float-end">Add Units</a> 
            </h4>
        </div>
        <div class="card-body">
        <?php  alertMessage(); ?>
        <?php 
            $units = getAll('units'); 
            if(!$units) {
                 echo '<h4>Something went wrong.</h4>';
                 return false;
            }
            if(mysqli_num_rows($units)>0) {
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($units as $item) : ?>
                        <tr>
                            <!-- <td><?= $item['id'] ?></td> -->
                            <td><?= $item['name'] ?></td>
                            <td>
                                <?php
                                    if($item['status'] == 1) {
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    } else {
                                        echo '<span class="badge bg-primary">Visible</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="units-edit.php?id=<?= $item['id'];?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="units-delete.php?id=<?= $item['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php 
                } else {
                    ?>
                        <h4 class="mb-0">No record found.</h4>
                    <?php
                } 
                ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>