<?php
// Mulai sesi untuk mengidentifikasi pengguna yang login
session_start();
$user_id = $_SESSION['user_id']; // Dapatkan user_id pengguna yang login

// Ambil ID tugas dari URL
$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'task_tracker');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data tugas berdasarkan ID dan user_id
$sql = "SELECT * FROM tasks WHERE id = $id AND user_id = $user_id"; // Pastikan hanya tugas pengguna yang sedang login yang dapat diedit
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = isset($row['title']) ? $row['title'] : '';
    $description = isset($row['description']) ? $row['description'] : '';
    $due_date = isset($row['due_date']) ? $row['due_date'] : '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data yang diubah dari formulir
        $new_title = $_POST['title'];
        $new_description = $_POST['description'];
        $new_due_date = $_POST['due_date'];

        // Perbarui data tugas
        $update_sql = "UPDATE tasks SET title = '$new_title', description = '$new_description', due_date = '$new_due_date' WHERE id = $id AND user_id = $user_id";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error updating task: " . $conn->error;
        }
    }

    // Menampilkan formulir pengeditan tugas
?>

<?php
} else {
    echo "Task not found or you don't have permission to edit it.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="navbar navbar-expand-md bg">
    <a href="index.php" class="navbar-brand fs-3 ms-3 text-white">
        <!-- <img src="logo.png" alt="Logo" class="logo"> -->
    </a>
    <button class="navbar-toggler me-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#btn">
        <i class='bx bx-menu bx-md'></i>
    </button>
    <div class="collapse navbar-collapse ul-bg" id="btn">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link mx-3 text-white fs-5">See task</a>
            </li>
            <li class="nav-item">
                <a href="../index.php" class="nav-link mx-3 text-white fs-5">Logout</a>
            </li>
        </ul>
    </div>
</nav>

    <form action="edit_task.php?id=<?php echo $id; ?>" method="post">
        <div class="container rounded" style="max-width: 500px; border: solid 2px rgb(149, 145, 145); margin-top:10%;">
            <h2>Edit Task</h2>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-group input-group-sm mb-3">
                <!-- <span class="input-group-text" id="inputGroup-sizing-sm">Small</span> -->
                <label style="margin-right: 5px;">Title : </label>
                <input type="text" class="form-control" name="title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $title; ?>">
            </div>
            <div class="input-group mb-3">
                <!-- <span class="input-group-text">With textarea</span> -->
                <label style="margin-right: 5px;">Description : </label>
                <textarea class="form-control" name="description" aria-label="With textarea"><?php echo $description; ?></textarea>
            </div>
            <div class="input-group mb-3">
                <label style="margin-right: 5px;">Due Date : </label>
                <input type="date" name="due_date" style="border: solid 2px rgb(149, 145, 145);" value="<?php echo $due_date; ?>">
            </div>
            <input type="submit" value="Save Changes" style="margin-bottom: 5px;margin-left:20%;margin-right:20%;border: solid 2px rgb(149, 145, 145);border-radius: 5px;">
    </div>
    </form>
</body>
</html>