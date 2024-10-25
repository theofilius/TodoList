<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md bg">
        <a href="index.php" class="navbar-brand fs-3 ms-3 text-white">
          
        </a>
        <button class="navbar-toggler me-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#btn">
            <i class='bx bx-menu bx-md'></i>
        </button>
        <div class="collapse navbar-collapse ul-bg" id="btn">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="add_task_form.php" class="nav-link mx-3 text-white fs-5">Add Task</a>
                </li>
                <li class="nav-item">
                    <a href="../index.php" class="nav-link mx-3 text-white fs-5">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-5">
        <h2>Task List</h2>
        <div class="table-responsive">
            <table class="table table-striped" style="width:100%">
                <style>
                    .table-striped .description-column {
                        max-width: 400px;
                        word-wrap: break-word;
                    }

                    .table {
                        border: 2px solid #ccc;
                        border-collapse: collapse;
                    }

                    .table th{
                        border: none;
                    }
                    .table td {
                        border: 2px solid #ccc;
                        padding: 8px;
                    }

                    .table-header {
                        border: 2px solid #ccc;
                        background-color: #f8f9fa;
                        
                    }

                    .table-header th {
                     
                    }
                </style>
                <thead>
                    <tr class="table-header">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    $user_id = $_SESSION['user_id'];

                    $conn = new mysqli('localhost', 'root', '', 'task_tracker');

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if (isset($_POST['newTask'])) {
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $due_date = $_POST['due_date'];

                        $sql = "INSERT INTO tasks (title, description, due_date, user_id) VALUES ('$title', '$description', '$due_date', '$user_id')";
                        $conn->query($sql);
                    }

                    if (isset($_POST['updateStatus'])) {
                        $task_id = $_POST['task_id'];
                        $new_status = $_POST['new_status'];

                        $sql = "UPDATE tasks SET status = '$new_status' WHERE id = $task_id";
                        $conn->query($sql);
                    }

                    if (isset($_GET['delete'])) {
                        $task_id = $_GET['delete'];

                        $sql = "DELETE FROM tasks WHERE id = $task_id AND user_id = $user_id";
                        $conn->query($sql);
                    }

                    $sql = "SELECT * FROM tasks WHERE user_id = '$user_id' ORDER BY status ASC, due_date ASC"; // Hanya menampilkan tugas pengguna yang sedang login
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td class="description-column">' . $row['description'] . '</td>';
                        echo '<td>' . $row['due_date'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td class="d-flex align-items-center">';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="task_id" value="' . $row['id'] . '">';
                        echo '<select name="new_status" class="form-select" style="width:200px;">';
                        echo '<option value="Not Started">Not Started</option>';
                        echo '<option value="In Progress">In Progress</option>';
                        echo '<option value="Waiting On">Waiting On</option>';
                        echo '<option value="Done">Done</option>';
                        echo '</select>';
                        echo '<input type="submit" name="updateStatus" value="Update Status" class="btn btn-primary btn-sm ms-2 mt-2">';
                        echo '<a href="edit_task.php?id=' . $row['id'] . '" class="btn btn-secondary btn-sm ms-2 mt-2" style="height: 30.6px;">Edit</a>';
                        echo '<a href="index.php?delete=' . $row['id'] . '" class="btn btn-danger btn-sm ms-2 mt-2" style="height: 30.6px;">Delete</a>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--jquery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!--DataTables-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>