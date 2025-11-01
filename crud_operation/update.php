<?php
$conn = new mysqli('localhost', 'root', '', 'crud_operation');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the student ID from URL
$id = $_GET['id'];

// Fetch current student data
$sql = "SELECT * FROM students WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// If the update form is submitted
if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];

    // Update the record
    $update_sql = "UPDATE students 
                   SET first_name='$first_name', last_name='$last_name', address='$address' 
                   WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect back to index after successful update
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Update Student</h2>
    <form method="post">
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" 
                   value="<?php echo $row['first_name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" 
                   value="<?php echo $row['last_name']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" 
                   value="<?php echo $row['address']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>