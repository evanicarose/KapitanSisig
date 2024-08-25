<?php include('includes/header.php'); ?>
<?php

// // Display session message if available
// if (isset($_SESSION['message'])) {
//     echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message']) . '</div>';
//     // Clear the message after displaying
//     unset($_SESSION['message']);
// }

// Updated SQL query to join the ingredients and units tables
$query = "SELECT ingredients.*, units.name AS unit_name FROM ingredients 
          LEFT JOIN units ON ingredients.unit_id = units.id";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
    <div class="card-header">
            <h4 class="mb-0">Ingredients
                <a href="ingredients-add.php" class="btn btn-primary float-end">Add Ingredient</a> 
            </h4>
        </div>
        <div class="card-body">
        <?php  alertMessage(); ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <!-- <td><?php echo htmlspecialchars($row['id']); ?></td> -->
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['unit_name']); ?></td> <!-- Display unit name -->
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['sub_category']); ?></td>
                            <td>
                                <a href="ingredients-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="ingredients-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
