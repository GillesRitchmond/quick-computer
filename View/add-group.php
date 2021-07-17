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
    <title>New group</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- BOOTSTRAP CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <div class="title program">
            New group
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a> -->
                <?php

                $id = $_GET["program"];
                // $code_entreprise = $_SESSION["code_entreprise"];

                $query = "SELECT * FROM program WHERE program.id_program = $id";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="program-details.php?program='.$row["id_program"].'" class="nav-link">
                            <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                        </a>';
                    }
                }
                ?>
            </span>
            <hr>
        </div>

        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="container mb-4">
            <?php

            if (isset($_POST["submit"])) {

                $nom = $_POST["name"];
                $description = $_POST["description"];
                $date_creation = date("d-m-y");
                $date_expiration = $_POST["date_expiration"];
                $id_program = $_GET["program"];

                $code_entreprise = $_SESSION["code_entreprise"];
                $code_user = $_SESSION["code_user"];

                $query = $conn->prepare("INSERT INTO groupe (nom_groupe, description, date_creation, date_expiration, id_program, code_user)
                                            VALUES (?, ?, ?, ?, ?, ?)");
                $query->bind_param("ssssii", $nom, $description, $date_creation, $date_expiration, $id_program, $code_user);

                if ($query->execute()) {
                    // echo "File sucessfully upload";
                    echo '<div class="alert alert-success" role="alert"> Enregistrement réussi ! </div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Echec d\'enregistrement ! </div>';
                }
            }

            ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description <span class="details">(Optionnal)</span></label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Expiration date</label>
                <input type="date" class="form-control" name="date_expiration" id="exampleFormControlInput1" required>
            </div>
            <button type="submit" name="submit" class="text-white btn btn-brand">Save group</button>
        </form>
    </div>

    <?php
        include_once('footer.php');
    ?>
</body>

</html>