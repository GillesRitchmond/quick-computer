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
    <title>User list</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- BOOTSTRAP CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- FONTS GOOGLE -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

</head>

<body class="body">
    <?php
    include_once('header.php');
    ?>
    <div class="header-content">

        <?php
        // $id = $_GET['group-details'];
        $code_entreprise = $_SESSION["code_entreprise"];

        $query = "SELECT * FROM entreprise, users WHERE users.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' LIMIT 1";
        $result = $conn->query($query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="title">' . $row["nom_entreprise"] . '</div>
                    <span class="subtitle">User : ' . $row["nom"] . ' ' . $row["prenom"]. '</span>';
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
                        // $id = $_GET["group-details"];
                        $code_entreprise = $_SESSION["code_entreprise"];

                        $query = "SELECT * FROM entreprise, users WHERE users.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' LIMIT 1";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="add-user.php" class="btn btn-outline-primary">New person</a>';
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

    <?php

    
    ?>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <?php

                // $id = $_GET["group-details"];
                $code_entreprise = $_SESSION["code_entreprise"];

                $query = "SELECT * FROM entreprise, users WHERE users.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' LIMIT 1";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="index.php" class="nav-link">
                        <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                    </a>';
                    }
                }
                ?>
                <hr class="hr">
            </span>
            <div class="list-content mt-3 mb-5">
                <div class="top"></div>
                <?php

                if (isset($_POST["searchAll"])) {
                    $search = $_POST["searchAll"];

                    // $id = $_GET["group-details"];
                    $code_entreprise = $_SESSION["code_entreprise"];

                    // RESULT FROM SEARCH BAR DOESN'T WORKS LIKE IT SUPPOSE TO WORK
                    // FUTURE BUG : RESULT MUST BE FETCH FOR THE ENTERPRISE THAT THE USER IS LOGIN ON IT
                    // ACTUAL BUG : RETURN THE NAME THAT YOU MAKE A SEARCH ON IT BUT RETURN IT MANY TIME -> QUERY IS NOT GOOD.-

                    $query = "SELECT * FROM entreprise, users, role WHERE role.id_role = users.id_role AND entreprise.code_entreprise = '$code_entreprise' 
                    AND users.code_entreprise = '$code_entreprise' AND users.nom LIKE '%$search%' OR users.prenom LIKE '%$search%' ORDER BY users.nom ASC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["id_statut"] == 1) {
                                $color = "green-circle";
                            } elseif ($row["id_statut"] == 2) {
                                $color = "red-circle";
                            }
                            // echo '<a href="person-details.php?person-details=' . $row["id_person"] . '" class="nav-link">';
                            echo' <div class="bg-white">
                                <div class="group-name-and-details">
                                    <div class="group-name">' . $row["nom"] . ' ' . $row["prenom"] . '<span class="' . $color . '" ></span></div>
                                    <div class="group-details">
                                        Role  : ' . $row["role_name"] . '</div>
                                    </div>';
                                    // <div class="group-more-details">
                                    //     <a href="person-details.php?person-details=' . $row["id_person"] . '"><i class="bi bi-chevron-right"></i></a>
                                    // </div>
                            echo '</div>';
                        //     echo '</div>
                        // </a>';
                        }
                    } else {
                        echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no person with this name...</div>
                            <div class="group-details">You can add a new person in this group !</div>
                        </div>
                    </div>';
                    }
                } else {

                    // $id = $_GET["group-details"];
                    $code_entreprise = $_SESSION["code_entreprise"];

                    $query = "SELECT * FROM entreprise, users, role WHERE role.id_role = users.id_role AND entreprise.code_entreprise = '$code_entreprise' AND users.code_entreprise = '$code_entreprise' ORDER BY users.nom ASC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["id_statut"] == 1) {
                                $color = "green-circle";
                            } elseif ($row["id_statut"] == 2) {
                                $color = "red-circle";
                            }
                            // echo '<a href="person-details.php?person-details=' . $row["id_person"] . '" class="nav-link">';
                            echo' <div class="bg-white">
                                <div class="group-name-and-details">
                                    <div class="group-name">' . $row["nom"] . ' ' . $row["prenom"] . '<span class="' . $color . '" ></span></div>
                                    <div class="group-details">
                                        Role  : ' . $row["role_name"] . '</div>
                                    </div>';
                                    // <div class="group-more-details">
                                    //     <a href="person-details.php?person-details=' . $row["id_person"] . '"><i class="bi bi-chevron-right"></i></a>
                                    // </div>
                            echo '</div>';
                        //     echo '</div>
                        // </a>';
                        }
                    } else {
                        echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no person here...</div>
                            <div class="group-details">Please add a new person in this group !</div>
                        </div>
                    </div>';
                    }
                }
                include_once('sidebar.php');
                ?>


            </div>
        </div>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

<script>
    function main() {
        show(document.getElementById('main'));
    }

    function close() {
        hide(document.getElementById('main'));
    }

    hide(document.getElementById('main'));

    function hide(elements) {
        elements = elements.length ? elements : [elements];
        for (var index = 0; index < elements.length; index++) {
            elements[index].style.display = 'none';
        }
    }

    function show(elements, specifiedDisplay) {
        elements = elements.length ? elements : [elements];
        for (var index = 0; index < elements.length; index++) {
            elements[index].style.display = specifiedDisplay || 'block';
        }
    }
</script>

</html>