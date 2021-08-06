<?php
include_once('../Model/connection.php');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if (isset($_POST["delete"])) {
    $id = $_GET["program"];
    $query = "DELETE FROM program WHERE id_program = $id";

    if ($conn->query($query) === TRUE) {
        // echo "Record deleted successfully";

        header('location: index.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!Doctype html>

<html>

<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>Edit program</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- BOOTSTRAP CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <!-- <div class="bullet-menu">
            <i class="bi bi-three-dots-vertical"></i>
        </div> -->
        <div class="title program">
            Edit the program
        </div>
    </div>

    <div class="third-part-content mb-5">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a> -->
                <a href="index.php" class="nav-link">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                </a>
            </span>
            <hr class="hr">
            <div class="top"></div>
        </div>

        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="container mb-5">
            <?php

            // date_default_timezone_set('America/Port-au-Prince');
            // $heure_sortie = date('Y-m-d');

            // echo $heure_sortie;

            if (isset($_POST["submit"])) {
                $id = $_GET["program"];


                $nom = $_POST["name"];
                $description = $_POST["description"];
                date_default_timezone_set('America/Port-au-Prince');
                // $date_creation = date('Y-m-d');
                $date_expiration = $_POST["date_expiration"];

                $code_entreprise = $_SESSION["code_entreprise"];
                $code_user = $_SESSION["code_user"];
                $fileToUpload = $_FILES['fileToUpload']['name'];


                // if (move_uploaded_file($file_loc, $folder . $final_file)) {
                if (empty($fileToUpload)) {


                    $query = $conn->prepare("UPDATE program SET program_name = ?, date_expiration = ?, description = ? WHERE id_program = '$id'");
                    $query->bind_param("sss", $nom, $date_expiration, $description);

                    if ($query->execute()) {
                        // echo "File sucessfully upload";
                        echo '<div class="alert alert-success" role="alert"> Update successful ! </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Update failed ! </div>';
                    }

                }

                    if ($fileToUpload != null) {
                        $file_name = $_FILES['fileToUpload']['name'];
                        $file = rand(1000, 100000) . "-" . $file_name;
                        $file_loc = $_FILES['fileToUpload']['tmp_name'];
                        $file_size = $_FILES['fileToUpload']['size'];
                        $file_type = $_FILES['fileToUpload']['type'];
                        $folder = "../Assets/images/";

                        /* new file size in KB */
                        $new_size = $file_size / 1024;
                        /* new file size in KB */

                        /* make file name in lower case */
                        $new_file_name = strtolower($file);
                        /* make file name in lower case */

                        $final_file = str_replace(' ', '-', $new_file_name);

                        move_uploaded_file($file_loc, $folder . $final_file);

                        $query = $conn->prepare("UPDATE program SET program_name = ?, date_expiration = ?, description = ?, image = ? WHERE id_program = '$id'");
                        $query->bind_param("ssss", $nom, $date_expiration, $description, $final_file);

                        if ($query->execute()) {
                            // echo "File sucessfully upload";
                            echo '<div class="alert alert-success" role="alert"> Update successful ! </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> Update failed ! </div>';
                        }
                    }
                
                }
            

            ?>


            <?php
            $id = $_GET["program"];
            $query = "SELECT * FROM program WHERE id_program = $id";
            $result = $conn->query($query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="' . $row["program_name"] . '" id="exampleFormControlInput1" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description <span class="details">(Optionnal)</span></label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"> ' . $row["description"] . '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Expiration date</label>
                        <input type="date" class="form-control"  value="' . $row["date_expiration"] . '" name="date_expiration" id="exampleFormControlInput1" >
                    </div>
                    <div class="mb-3 form_field">
                        <label for="fileSelect">Filename:</label>
                        <input type="file" name="fileToUpload"  value="' . $row["image"] . '" class="form-control-file" >
                    </div>';
                }
            }
            ?>
            <button type="submit" name="submit" class="text-white mb-5 btn btn-brand">Update</button>
            <button type="submit" name="delete" class="text-white mb-5 btn btn-danger col-md">Delete</button>
        </form>
    </div>


    <?php

    include_once('footer.php');
    ?>
</body>

</html>