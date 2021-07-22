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
    <title>Person Details</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">

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
    <?php
    include_once('header.php');
    ?>
    <div class="header-content">
        <!-- <div class="bullet-menu">
            <i class="bi bi-list"></i>
        </div> -->
        <div class="title">
            <?php
            $id_person = $_GET["person-details"];
            $query = "SELECT * FROM personne, groupe, program WHERE id_person = $id_person AND groupe.id_program = program.id_program AND personne.id_group = groupe.id_group LIMIT 1";
            $result = $conn->query($query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<span class="fs-2 text-white details"> <b>Pr : </b>' . $row["program_name"] . '<br> <b>Gp : </b>' . $row["nom_groupe"] . '</b> <br> <b>Pe : </b>' . $row["nom"] . ' ' . $row["prenom"] . '</span>';
                }
            }
            ?>

        </div>
    </div>

    <div class="third-part-content">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a>  -->
                <?php
                $id = $_GET["person-details"];
                // $code_entreprise = $_SESSION["code_entreprise"];

                $query = "SELECT * FROM personne, program, groupe WHERE id_person = $id_person AND groupe.id_program = program.id_program AND personne.id_group = groupe.id_group";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="group.php?group-details=' . $row["id_group"] . '" class="nav-link">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                </a>';
                    }
                }
                ?>
                <hr class="hr">
            </span>
            <div class="top"></div>
        </div>


        <form action="" method="post" class="container mb-5">
            <div id="alert_message">
                <?php

                if (isset($_POST["submit"])) {
                    try {
                        $nom = $_POST["nom"];
                        $prenom = $_POST["prenom"];
                        $email = $_POST["email"];
                        $lieu_naissance = $_POST["lieu"];
                        $date_naissance = $_POST["date"];
                        $adresse = $_POST["adresse"];
                        $tel_1 = $_POST["tel_1"];
                        $tel_2 = $_POST["tel_2"];
                        $id_group = $_GET["group-details"];
                        $id_program = $_GET["program-details"];

                        // $code_entreprise = $_SESSION["code_entreprise"];
                        // $code_entreprise = "ckhardware.qc";

                        // $h_password = password_hash($password, PASSWORD_DEFAULT);

                        $stmt_user = $conn->prepare("UPDATE personne SET nom = ?, prenom = ?, date_naissance = ?, lieu_naissance = ?, telephone_1 = ?, telephone_2 = ?, adresse = ?, email = ?, id_group = ?, id_program = ?");
                        $stmt_user->bind_param('ssssssssii', $nom, $prenom, $date_naissance, $lieu_naissance, $tel_1, $tel_2, $adresse, $email, $id_group, $id_program);

                        if ($stmt_user->execute()) {
                            echo '<div class="alert alert-success" role="alert">
                            Mise à jour réussi !
                        </div>';
                        }
                    } catch (PDOException $e) {

                        echo '<div class="alert alert-danger" role="alert">
                    L\' enregistrement n\'a pas été faite  !
                    </div>';
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </div>

            <?php

            if (isset($_SESSION["role"]) && $_SESSION["role"] === 1) {
                $edit = "readonly";
                $editText = "";
            } else {
                $edit = "";
                $editText = '<button type="submit" name="submit" class="mb-5 text-white btn btn-brand"> Save person</button>';
            }

            $id = $_GET["person-details"];
            // $code_entreprise = $_SESSION["code_entreprise"];

            $query = "SELECT * FROM personne, program, groupe WHERE id_person = $id_person AND groupe.id_program = program.id_program AND personne.id_group = groupe.id_group";
            $result = $conn->query($query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    if ($row["id_statut"] == 1) {
                        $checked = "checked";
                        $statut = "Activated";
                    } else {
                        $checked = "";
                        $statut = "Isn't activated";
                    }

                    if ($row["id_dependant"] === null) {
                        echo "<script> hide(document.getElementById('dependant-list-field')); </script>";
                    }

                    echo '
                    <div class="profile-img-size mb-3">
                        <img src="../Assets/profile/' . $row["profile_image"] . '" class="profile-img-content" alt="">
                    </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" value="' . $row["nom"] . '"' . $edit . ' required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" value="' . $row["prenom"] . '"' . $edit . ' required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" value="' . $row["email"] . '"' . $edit . '  required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Birth date</label>
                <input type="date" class="form-control" name="date" id="exampleFormControlInput1" value="' . $row["date_naissance"] . '"' . $edit . '  required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Birth place</label>
                <input type="text" class="form-control" name="lieu" id="exampleFormControlInput1" value="' . $row["lieu_naissance"] . '" ' . $edit . ' required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" value="' . $row["adresse"] . '"' . $edit . '  required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone 1</label>
                <input type="number" class="form-control" name="tel_1" id="exampleFormControlInput1"  value="' . $row["telephone_1"] . '" ' . $edit . ' required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone 2 <span class="details">(Optionnal)</span></label>
                <input type="number" class="form-control" name="tel_2" value="' . $row["telephone_2"] . '" ' . $edit . '  id="exampleFormControlInput1">
            </div>
            <div class="mb-3 form_field">
                <label for="fileSelect">Profile picture:</label>
                <input type="file" name="fileToUpload" class="form-control-file" value="' . $row["profile_image"] . '" ' . $edit . ' >
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="hidden" name="id_statut" value="2" id="flexSwitchCheckChecked">
                <input class="form-check-input" type="checkbox" name="id_statut" value="' . $row["id_statut"] . '" ' . $checked . ' ' . $edit . 'id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexCheckDefault">
                    ' . $statut . '
                </label>
            </div>

            <div class="dependant" id="dependant-list-field">
                <label class="form-label">Information about dependant(s)</label>
            <hr>
            <b>First Dependant</b> <br>
                <div class="mb-3" id="first-dependant">
                    <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                    <input type="text" class="form-control" name="nom_dependant" id="exampleFormControlInput1" ' . $edit . '>
                </div>
                <div class="mb-3"id="first-dependant">
                    <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                    <input type="text" class="form-control" name="prenom_dependant" id="exampleFormControlInput1" ' . $edit . ' >
                </div>
            <hr>
            <div class="second-dependant" id="second-dependant">
                <b>Second dependant</b> <br>
                    <div class="mb-3" id="second-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="nom_dependant_2" ' . $edit . ' id="exampleFormControlInput1" >
                    </div>
                    <div class="mb-3"id="first-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="prenom_dependant_2" ' . $edit . ' id="exampleFormControlInput1" >
                    </div>
                <hr>
            </div>
            <div class="third-dependant" id="third-dependant">
                <b>Third dependant</b> <br>
                    <div class="mb-3" id="third-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="nom_dependant_3" id="exampleFormControlInput1" ' . $edit . ' >
                    </div>
                    <div class="mb-3"id="third-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="prenom_dependant_3" id="exampleFormControlInput1" ' . $edit . ' >
                    </div>
                </div>
            </div>';
                    echo $editText;
                }
            }
            ?>

        </form>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

<script>
    // hide(document.getElementById('dependant-list-field'));

    // function dependant()
    // {
    //     show(document.getElementById('dependant-list-field'));
    //     hide(document.getElementById('second-dependant'));
    //     hide(document.getElementById('third-dependant'));
    // }

    // function second_dependant()
    // {
    //     show(document.getElementById('dependant-list-field'));
    //     show(document.getElementById('second-dependant'));
    //     hide(document.getElementById('third-dependant'));

    // }
    // function third_dependant()
    // {
    //     show(document.getElementById('dependant-list-field'));
    //     show(document.getElementById('second-dependant'));
    //     show(document.getElementById('third-dependant'));
    // }

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