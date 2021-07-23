<?php
include_once('../Model/connection.php');
session_start();

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
    <title>Program details</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

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

<body class="body">
    <?php
    include_once('header.php');
    ?>
    <div class="header-content">
        <!-- <div class="bullet-menu">
            <i class="bi bi-list"></i>
        </div> -->
        <?php
        $id = $_GET['program'];
        $query = "SELECT * FROM users, program WHERE users.code_user = program.code_user AND id_program = $id LIMIT 1";
        $result = $conn->query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="title">' . $row["program_name"] . '</div>
                    <span class="subtitle">Created : ' . $row["date_creation"] . '</span>';
            }
        }
        ?>
    </div>


    <div class="second-part-content">
        <div class="search">
            <div class="custom-container">
                <form action="" method="post" class="">
                    <i class="bi bi-search"></i>
                    <input type="text" name="searchAll" id="" placeholder="Search" class="search-main">
                </form>
            </div>
            <div class="link">
                <ul>
                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 3 || $_SESSION["role"] === 2) {
                        echo '<li>';
                        $id = $_GET["program"];
                        // $code_entreprise = $_SESSION["code_entreprise"];

                        $query = "SELECT * FROM program WHERE program.id_program = $id";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="add-group.php?program=' . $row["id_program"] . '" class="btn btn-outline-primary">New group</a>';
                            }
                        }
                        echo '</li> <li><a href="report.php" class="btn btn-outline-muted">Report</a></li>';
                    } elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 1) {
                        echo '<li><a href="report.php" class="btn btn-outline-muted">Report</a></li>';
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <a href="index.php">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span> Back
                </a>
                <hr class="hr">
            </span>
            <div class="list-content mt-3 mb-5">
            <div class="top"></div>
                <?php

                if (isset($_POST["searchAll"])) {
                    $search = $_POST["searchAll"];
                    $id = $_GET["program"];
                    $code_entreprise = $_SESSION["code_entreprise"];

                    $query = "SELECT * FROM entreprise, program, groupe, users WHERE users.code_entreprise = '$code_entreprise' AND program.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' ANDnom_groupe LIKE '%$search%' AND program.id_program = $id AND groupe.id_program = $id AND users.code_user = groupe.code_user ORDER BY groupe.id_group DESC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="group.php?group-details=' . $row["id_group"] . '" class="nav-link">
                            <div class="bg-white">
                                <div class="group-name-and-details">
                                    <div class="group-name">' . $row["nom_groupe"] . '</div>
                                    <div class="group-details"> 
                                        <b>Created : </b>' . $row["date_creation"] . ' <br>
                                        <b>By : </b>' . $row["nom"] . ' ' . $row["prenom"] . '</div>
                                    </div>
                                    <div class="more-details">
                                        <a href="group.php?group-details=' . $row["id_group"] . '"><i class="bi bi-chevron-right"></i></a>
                                    </div>
                            </div>
                        </a>';
                        }
                    } else {
                        echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no group with this name...</div>
                            <div class="group-details">Please create a new group in this program !</div>
                        </div>
                    </div>';
                    }
                } else {
                    $id = $_GET["program"];
                    $code_entreprise = $_SESSION["code_entreprise"];

                    $query = "SELECT * FROM entreprise, program, groupe, users WHERE users.code_entreprise = '$code_entreprise' AND program.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' AND program.id_program = $id AND groupe.id_program = $id AND users.code_user = groupe.code_user ORDER BY groupe.id_group DESC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="group.php?group-details=' . $row["id_group"] . '" class="nav-link">
                            <div class="bg-white">
                                <div class="group-name-and-details">
                                    <div class="group-name">' . $row["nom_groupe"] . '</div>
                                    <div class="group-details"> 
                                        <b>Created : </b>' . $row["date_creation"] . ' <br>
                                        <b>By : </b>' . $row["nom"] . ' ' . $row["prenom"] . '</div>
                                    </div>
                                    <div class="more-details">
                                        <a href="group.php?group-details=' . $row["id_group"] . '"><i class="bi bi-chevron-right"></i></a>
                                    </div>
                            </div>
                        </a>';
                        }
                    } else {
                        echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no group here...</div>
                            <div class="group-details">Please create a new group in this program !</div>
                        </div>
                    </div>';
                    }
                }

                ?>
                <?php
                include_once('sidebar.php');
                ?>

            </div>
        </div>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

</html>