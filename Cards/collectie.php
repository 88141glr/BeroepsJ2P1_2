<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='Style/project.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header class="p-3 text-bg-warning">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../index.php" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="../info.php" class="nav-link px-2 text-white">Info</a></li>
          <li><a href="#" class="nav-link px-2 text-secondary">Cards</a></li>
        </ul>


        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                // Show the "Logout" link when logged in
                echo '<div class="dropdown text-end">';
                echo '<a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                echo '<img src="../Media/icon.png" alt="mdo" width="32" height="32" class="rounded-circle">';
                echo '</a>';
                echo '<ul class="dropdown-menu text-small">';
                echo '<li><a class="dropdown-item" href="../ADMIN/adminprojects.php">Remove Cards</a></li>';
                echo '<li><a class="dropdown-item" href="../ADMIN/adminupload.php">Upload Cards</a></li>';
                echo '<li><hr class="dropdown-divider"></li>';
                echo ' <li><a class="dropdown-item" href="../ADMIN/Login/logout.php">Sign out</a></li>';
                echo '</ul>';
            } else {
                // Show the "Login" link when not logged in
                echo '   <div class="text-end">';
                echo '   <a href="../ADMIN/Login/login.php"><button type="button" class="btn btn-outline-light me-2" >Login</button></a>';
                echo '  </div>';
            }
            ?>

        </header>
        <br>
        <br>
</body>
</html>

<?php
$servername = "localhost";
$username = "db88141";
$password = "Kaas1001!";
$dbname = "88141_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Cards";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        if ($count % 3 == 0) {
            // Start a new row
            echo "<div class='project-row'>";
        }
        echo "<div class='project-card'>";
        echo "<h2>" . $row['Name'] . "</h2>";
        echo "<img class='project-image' src='" . $row['image_path'] . "' alt='Project Image'><br/>";
        echo "<a class='project-link' href='" . $row['Description'] . "'>View</a>";
        echo "</div>";
        $count++;
        if ($count % 3 == 0) {
            // End the row after 3 cards
            echo "</div>";
        }
    }
} else {
    echo "No cards found.";
}
$conn->close();
?>