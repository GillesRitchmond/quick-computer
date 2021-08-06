<?php
include_once('../../Model/connection.php');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
    exit;
}


if(isset($_POST["delete"]) && isset($_GET["view-entreprise"]))
{
    $id = $_GET["view-entreprise"];
    $query = "DELETE FROM entreprise WHERE id_ent = $id";

    if ($conn->query($query) === TRUE) {
        // echo "Record deleted successfully";

        header('location: index.php');
      } else {
        echo "Error deleting record: " . $conn->error;
      }

}elseif(isset($_POST["delete"]) && isset($_GET["edit-entreprise"]))
{
    $id = $_GET["edit-entreprise"];
    $query = "DELETE FROM entreprise WHERE id_ent = $id";

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
    <title>About enterprise</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">

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
            About Enterprise
        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a> -->
                <?php
                echo '<a href="index.php" class="nav-link">
                            <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                        </a>';
                ?>
            </span>
            <hr>
        </div>

        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="container mb-5">
            <?php

            if (isset($_POST["submit"]) || isset($_POST["edit-submit"])) {
                
                $nom_entreprise = $_POST["name"];
                $code_entreprise = $_GET["edit-entreprise"];
                $date_expiration = $_POST["date_expiration"];
                $id_statut = $_POST["id_statut"];
                
                $query = $conn->prepare("UPDATE entreprise SET nom_entreprise = ?, date_expiration = ?, statut_id = ? WHERE code_entreprise = '$code_entreprise'");
                $query->bind_param("ssi", $nom_entreprise, $date_expiration, $id_statut);

                if ($query->execute()) {
                    // echo "File sucessfully upload";
                    echo '<div class="alert alert-success" role="alert"> Saved successfully ! </div>';
                    // header('user-to-enterprise.php');
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Registration failed ! </div>';
                }
            }

            ?>
            <?php

            
           

            if(isset($_GET["view-entreprise"]))
            {
                $id = $_GET["view-entreprise"];
                $query = "SELECT * FROM entreprise, statut WHERE entreprise.statut_id = statut.id_statut AND code_entreprise = '$id'";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
    
                        if ($row["statut_id"] == 1) {
                            $checked = "checked";
                            $statut = "Activated";
                        } else {
                            $checked = "";
                            $statut = "Isn't activated";
                        }
                        $readOnly = 'readonly';
    
                        echo '<div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code enterprise</label>
                            <input type="text" class="form-control" value="' . $row['code_entreprise'] . '" name="code" id="exampleFormControlInput1" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Enterprise name<span class="details"></span></label>
                            <input type="text" class="form-control" value="' . $row['nom_entreprise'] . '" '.$readOnly.' name="name" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Expiration date</label>
                            <input type="date" class="form-control" value="' . $row['date_expiration'] . '" '.$readOnly.' name="date_expiration" id="exampleFormControlInput1" required>
                        </div>
    
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="hidden" name="id_statut" value="2" id="flexSwitchCheckChecked">
                            <input class="form-check-input" type="checkbox" name="id_statut" value="' . $row["statut_id"] . '" '.$readOnly.' ' . $checked . ' id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexCheckDefault">
                                ' . $statut . '
                            </label>
                        </div>';
                        echo' <button type="submit" name="delete" class="mt-3 text-white mb-5 btn btn-danger col-md">Delete</button>';
                    }
                }
            }elseif(isset($_GET["edit-entreprise"])){

                $id = $_GET["edit-entreprise"];
                $query = "SELECT * FROM entreprise, statut WHERE entreprise.statut_id = statut.id_statut AND code_entreprise = '$id'";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
    
                        if ($row["statut_id"] == 1) {
                            $checked = "checked";
                            $statut = "Activated";
                        } else {
                            $checked = "";
                            $statut = "Isn't activated";
                        }
                        $readOnly = 'readonly';
    
                        echo '<div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code enterprise</label>
                            <input type="text" class="form-control" value="' . $row['code_entreprise'] . '" name="code" id="exampleFormControlInput1" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Enterprise name<span class="details"></span></label>
                            <input type="text" class="form-control" value="' . $row['nom_entreprise'] . '" name="name" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Expiration date</label>
                            <input type="date" class="form-control" value="' . $row['date_expiration'] . '" name="date_expiration" id="exampleFormControlInput1" required>
                        </div>
    
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="hidden" name="id_statut" value="2" id="flexSwitchCheckChecked">
                            <input class="form-check-input" type="checkbox" name="id_statut" value="' . $row["statut_id"] . '" ' . $checked . ' id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexCheckDefault">
                                ' . $statut . '
                            </label>
                        </div>';

                        echo'<button type="submit" name="edit-submit" class="mt-3 text-white btn btn-brand mb-5">Edit program</button>
                        <button type="submit" name="delete" class="text-white mb-5 btn btn-danger col-md">Delete</button>';
                    }
                }   
            }

            ?>
            
        </form>
    </div>

    <?php
    // include_once('footer.php');
    ?>
</body>

</html>