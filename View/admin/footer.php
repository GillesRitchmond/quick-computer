<?php
include_once('../../Model/connection.php');
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
    <link rel="stylesheet" href="../css/style.css">
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

    <nav class="nav">
        <a href="../index.php" class="nav__link">
            <i class="bi bi-grid-fill nav__icon"></i> 
            <span class="nav__text">Home</span> 
        </a>
        <a href="../list-group.php" class="nav__link">
            <i class="bi bi-menu-button-fill nav__icon"></i> 
            <span class="nav__text">Group</span> 
        </a>
        <a href="../create-program.php" class="nav__link nav__link--active">
            <i class="bi bi-plus-circle-fill nav__icon"></i> 
            <span class="nav__text">Add</span> 
        </a>
        <a href="../list-person.php" class="nav__link">
            <i class="bi bi-person-lines-fill nav__icon"></i> 
            <span class="nav__text">Person</span> 
        </a>
        <a href="#" class="nav__link">
            <i class="bi bi-gear-fill nav__icon"></i> 
            <span class="nav__text">Settings</span> 
        </a>

    </nav>
</body>

</html>