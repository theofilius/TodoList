<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $new_password = $_POST["password"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "task_tracker";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $email);
    
    // Cek apakah email tersebut terdaftar dalam database
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row["id"];

        // Enkripsi password baru
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Perbarui password dalam database
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
        if (mysqli_query($conn, $update_query)) {
            $password_changed = true;
        } else {
            $password_changed = false;
        }
    } else {
        $password_changed = false;
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css">
    <title>Change Password</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="post" onsubmit="return showNotification()">
                    <h2>Change Password</h2>
                    <?php
                        if (isset($password_changed) && $password_changed) {
                            echo '<div class="success-notification">Password changed successfully.</div>';
                        } elseif (isset($password_changed) && !$password_changed) {
                            echo '<div class="error-notification">Wroong email</div>';
                        }
                    ?>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required name="email" id="email">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required name="password" id="password">
                        <label for="">New Password</label>
                    </div>
                    <button id="registerButton" type="submit">Change</button>
                    <div class="register">
                        <p><a href="index.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function showNotification() {
            return true; 
        }
    </script>
</body>
</html>
