<?php
include_once('../Model/connection.php');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

// http_response_code(404);
// include('404.php'); // provide your own HTML for the error page
// die();

?>

<!Doctype html>

<html>

<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>Home</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">

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

    <!-- ANIMATION -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body class="body">
    <?php
    include_once('header.php');
    ?>

    <div class="header-content">
        <div class="title">
            Dashboard
        </div>
        <span class="subtitle">User:
            <?php $nom = $_SESSION["nom"];
            $prenom = $_SESSION["prenom"];
            echo $nom . ' ' . $prenom; ?>
        </span>
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
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 3) {
                        echo '<li><a href="add-user.php" class="btn btn-outline-primary">New user</a></li>
                            <li><a href="create-program.php" class="btn btn-outline-secondary">New program</a></li>
                            <li><a href="report.php" class="btn btn-outline-muted">Report</a></li>';
                    } elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 2) {
                        echo '<li><a href="add-user.php" class="btn btn-outline-primary">New user</a></li>
                            <li><a href="create-program.php" class="btn btn-outline-secondary">New program</a></li>';
                    } elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 1) {
                        echo '<li><a href="report.php" class="col-md btn btn-outline-muted">Report</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <a>
                    Programs List
                </a>
                <hr class="hr">
            </span>
            <div class="list-content mt-3 mb-5">
                <div class="top"></div>
                <?php

                if (isset($_POST["searchAll"])) {

                    $search = $_POST["searchAll"];
                    $code_entreprise = $_SESSION["code_entreprise"];
                    
                    $query = "SELECT * FROM entreprise, program, users WHERE entreprise.code_entreprise = '$code_entreprise' AND program.code_entreprise = '$code_entreprise' 
                    AND users.code_entreprise = '$code_entreprise' AND program_name LIKE '%$search%' AND users.code_user = program.code_user ORDER BY id_program DESC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="program-details.php?program=' . $row["id_program"] . '" class="nav-link">
                            <div class="bg-white">
                                <div class="img-size">
                                    <img src="../Assets/images/' . $row["image"] . '" class="img-content" alt="">
                                </div> 
                                <div class="name-and-details">
                                    <div class="name">' . $row["program_name"] . '</div>
                                    <div class="details">
                                     Created : ' . $row["date_creation"] . '<br> 
                                     By : ' . $row["nom"] . ' ' . $row["prenom"] . '</div>
                                </div>';
                                // <div class="more-details">
                                //     <a href="program-details.php?program=' . $row["id_program"] . '"><i class="bi bi-chevron-right"></i></a>
                                // </div>
                           echo '</div>
                        </a>';
                        }
                    } else {
                        echo '<div class="bg-white">
                        <div class="group-name-and-details">
                            <div class="group-name">There is no program for your enterprise...</div>
                            <div class="group-details">Please create a new program !</div>
                        </div>
                    </div>';
                    }
                } else {

                    // $more_details = "program-details.php?program=' . $row["id_program"] . '"
                    $code_entreprise = $_SESSION["code_entreprise"];

                    $query = "SELECT * FROM entreprise, program, users WHERE entreprise.code_entreprise = '$code_entreprise' AND program.code_entreprise = '$code_entreprise' 
                    AND users.code_entreprise = '$code_entreprise' AND users.code_user = program.code_user ORDER BY id_program DESC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="bg-white">';
                                // <div class="bg-white-content">
                                    echo '<a href="program-details.php?program=' . $row["id_program"] . '" class="nav-link">
                                        <div class="img-size">
                                            <img src="../Assets/images/' . $row["image"] . '" class="img-content" alt="">
                                        </div> 
                                        <div class="name-and-details">
                                            <div class="name">' . $row["program_name"] . '</div>
                                            <div class="details">
                                            Created : ' . $row["date_creation"] . '<br> 
                                            By : ' . $row["nom"] . ' ' . $row["prenom"] . '</div>
                                        </div>
                                    </a>';

                            echo '</div> ';
                        }
                    }else {
                        echo '<div class="bg-white">
                            <div class="group-name-and-details">
                                <div class="group-name">There is no program for your enterprise...</div>
                                <div class="group-details">Please create a new program !</div>
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

<script>
    $(".userForm").addClass("hide");
    $('.openUserEditBox').click(function() {
        $(".userForm").removeClass("hide");
        $(".userForm").addClass("show");
    });
    $('.closeUserEditBox').click(function() {
        $(".userForm").removeClass("show");
        $(".userForm").addClass("hide");
    });
</script>

</html>