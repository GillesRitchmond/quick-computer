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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>

    <!-- <div class="modal">
        <div class="modal-box">
            <div class="header-section">
                Menu <hr>
                <span></span>
            </div>
            <div class="middle-section">
                <ul class="nav-link">
                    <li class="link"><a href="#">Report</a></li>
                    <li class="link"><a href="#">Manage users</a></li>
                    <li class="link"><a href="#">Settings</a></li>
                    <li class="link"><a href="#">Logout</a></li>
                </ul>

            </div>
            <div class="bottom-section">

            </div>
        </div>
    </div> -->
    
    <div class="header-content">
        <div class="bullet-menu text-white">
            <a href="../Controller/logout.php" class="text-white nav-link"><i class="bi bi-box-arrow-right"></i></a>
        </div>
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
                        if(isset($_SESSION["role"]) && $_SESSION["role"] === 3)
                        {
                            echo '<li><a href="add-user.php" class="btn btn-outline-primary">New user</a></li>
                            <li><a href="create-program.php" class="btn btn-outline-secondary">New program</a></li>
                            <li><a href="report.php" class="btn btn-outline-muted">Report</a></li>';
                        }
                        elseif(isset($_SESSION["role"]) && $_SESSION["role"] === 2)
                        {
                            echo '<li><a href="add-user.php" class="btn btn-outline-primary">New user</a></li>
                            <li><a href="create-program.php" class="btn btn-outline-secondary">New program</a></li>';
                        }
                        elseif(isset($_SESSION["role"]) && $_SESSION["role"] === 1)
                        {
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
                <hr>
            </span>
            <div class="list-content mt-3 mb-5">
                <?php

                $query = "SELECT * FROM program, users WHERE users.code_user = program.code_user ORDER BY id_program DESC";
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
                                </div>
                                <div class="more-details">
                                    <a href="program-details.php?program=' . $row["id_program"] . '"><i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </a>';
                    }
                }

                ?>


            </div>
        </div>
    </div>

    <?php
        include_once('footer.php');
    ?>
</body>

</html>