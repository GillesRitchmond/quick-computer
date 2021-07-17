<?php
include_once('../Model/connection.php');
// session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}
?>

<!Doctype html>

<html>

<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <!-- <title>Home</title> -->

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/main.css"> -->

    <!-- BOOTSTRAP CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>
    <nav class="footer-bg-white">
        <div class="list">
            <ul >
                <li>
                    <a class="disable" href="index.php"> <i class="bi bi-grid-fill"></i> <span class="tag-bottom">home</span> </a>
                </li>

                <li>
                    <a class="disable" href="list-group.php"><i class="bi bi-menu-button-fill"></i> <span class="tag-bottom">Group</span> </a>
                </li>
                
                <li>
                    <a class="" href="create-program.php"> <i class="bi bi-plus-circle-fill"></i> <span class="add tag-bottom">Add</span></a>
                </li>
                
                <li>
                    <a class="disable" href="list-person.php"> <i class="bi bi-person-lines-fill"></i> <span class="tag-bottom">Persons</span> </a>
                </li>

                <li>
                    <a class="disable" href="settings.php"> <i class="bi bi-gear-fill"></i> <span class="tag-bottom">Settings</span> </a>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>