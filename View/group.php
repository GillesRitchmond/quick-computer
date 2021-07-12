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
    <title>Group list</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">

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
    <div class="header-content">
        <div class="bullet-menu">
            <i class="bi bi-three-dots-vertical"></i>
        </div>
        <?php
            $id = $_GET['group-details'];
            $query = "SELECT * FROM users, program, groupe WHERE users.code_user = program.code_user AND groupe.id_program = program.id_program AND id_group = $id LIMIT 1";
            $result = $conn->query($query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="title">'.$row["nom_groupe"].'</div>
                    <span class="subtitle">Created : '.$row["date_creation"].' by : '.$row["nom"].' '.$row["prenom"].'</span>';
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
                    <li>
                        <?php
                            $id = $_GET["group-details"];
                            // $code_entreprise = $_SESSION["code_entreprise"];
            
                            $query = "SELECT * FROM groupe WHERE groupe.id_group = $id";
                            $result = $conn->query($query);
            
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { 
                                    echo '<a href="add-person.php?group-details='.$row["id_group"].'" class="btn btn-outline-primary">New person</a>'; 
                                }
                            }
                        ?>
                    </li>
                    <!-- <li><a href="add-group.php" class="btn btn-outline-secondary">New group</a></li> -->
                    <li><a href="report.php" class="btn btn-outline-muted">Report</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
            <?php

            $id = $_GET["group-details"];
            // $code_entreprise = $_SESSION["code_entreprise"];

            $query = "SELECT * FROM program, groupe WHERE groupe.id_group = $id AND program.id_program = groupe.id_program";
            $result = $conn->query($query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="program-details.php?program='.$row["id_program"].'" class="nav-link">
                        <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                    </a>';
                }
            }
            ?>
                <hr>
            </span>
            <div class="list-content mt-3">

                <?php
                $id = $_GET["group-details"];
                $code_entreprise = $_SESSION["code_entreprise"];

                $query = "SELECT * FROM program, groupe, personne WHERE personne.id_program = program.id_program AND personne.id_group = groupe.id_group AND groupe.id_program = program.id_program AND personne.id_group = $id ORDER BY personne.nom ASC";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="person-details.php?person-details=' . $row["id_person"] . '" class="nav-link">
                            <div class="bg-white">
                                <div class="group-name-and-details">
                                    <div class="group-name">'.$row["nom"].' '. $row["prenom"].'</div>
                                    <div class="group-details">
                                        Email  : '.$row["email"].'</div>
                                    </div>
                                    <div class="group-more-details">
                                        <a href="person-details.php?person-details=' . $row["id_person"] . '"><i class="bi bi-chevron-right"></i></a>
                                    </div>
                            </div>
                        </a>';
                    }
                } else {
                    echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no person here...</div>
                            <div class="group-details">Please add a new person in this group !</div>
                        </div>
                    </div>';
                }

                ?>


            </div>
        </div>
    </div>
</body>

</html>