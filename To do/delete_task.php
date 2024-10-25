<!DOCTYPE html>
<html>

<head>
    <title>Confirm Delete</title>
</head>

<body>
    <h1>Confirm Delete</h1>
    <?php
    $id = $_GET['id'];

    $conn = new mysqli('localhost', 'root', '', 'task_tracker');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tasks WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <p>Are you sure you want to delete the task "<?php echo $row['title']; ?>"?</p>
    <form action="delete_task_confirm.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Yes">
    </form>
    <a href="index.php">No, go back</a>
</body>

</html>