<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="index.php" class="nav-link mx-3 text-white fs-5">See Your Task</a>
            </li>
            <li class="nav-item">
                <a href="../index.php" class="nav-link mx-3 text-white fs-5">Logout</a>
            </li>
        </ul>
    </div>
</nav>

    
    <form action="index.php" method="post">
    <div class="contact form">
    <h2>Add Task</h2>
    <form action="index.php" method="post">
        <div class="box">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>
        <div class="box">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" aria-label="With textarea" required></textarea>
        </div>
        <div class="box">
            <label for="due_date">Due Date:</label>
            <input type="date" class="form-control" name="due_date" required>
        </div>
        <input type="submit" name="newTask" value="Add Task" class="btn-submit">
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<!-- add_task_form.php -->