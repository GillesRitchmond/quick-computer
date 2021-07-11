<?php
    include_once('../Model/connection.php');
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <title>Home</title>

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

<body>
    <div class="header-content">
        <div class="bullet-menu text-white">
            <a href="../Controller/logout.php" class="text-white nav-link"><i class="bi bi-three-dots-vertical"></i></a>
        </div>
        <div class="title">
            Dashboard
        </div>
        <span class="subtitle">User: <?php $nom = $_SESSION["nom"]; $prenom = $_SESSION["prenom"]; echo $nom . ' ' . $prenom?></span>
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
                    <li><a href="add-user.php" class="btn btn-outline-primary">New user</a></li>
                    <li><a href="create-program.php" class="btn btn-outline-secondary">New program</a></li>
                    <li><a href="report.php" class="btn btn-outline-muted">Report</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <a href="">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span> Programs List
                </a>
                <hr>
            </span>
            <div class="list-content mt-3">
                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse@2x.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/collection-logo-miel-design-plat_23-2147659652@2x.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/download@2x.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>


                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/istockphoto-1042533778-612x612@2x.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

                <div class="bg-white">
                    <div class="img-size">
                        <img src="images/code-promo-abeille-heureuse.png" class="img-content" alt="">
                    </div>
                    <div class="name-and-details">
                        <div class="name">Bonus Card</div>
                        <div class="details">Contain : 5 groupes | Created : 24/6/2021 by : JohnDoe1234</div>
                    </div>
                    <div class="more-details">
                        <a href="program-details.php"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer container">
        <a href="#" class="add-button">
            <i class="bi bi-plus-square-fill"></i>
        </a>
    </div>
</body>

</html>