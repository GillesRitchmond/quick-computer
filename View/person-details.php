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

            // ???

            if (isset($_SESSION["role"]) && $_SESSION["role"] === 1) {
                $edit = "readonly";
                $editText = "";
            } else {
                $edit = "";
                $editText = '<button type="submit" name="submit" class="mb-5 text-white btn btn-brand"> Save person</button>';
            }

            $id = $_GET["person-details"];
            // $code_entreprise = $_SESSION["code_entreprise"];

            $query = "SELECT * FROM personne, dependant, program, groupe WHERE personne.id_dependant = dependant.id_dependant AND id_person = '$id_person' AND groupe.id_program = program.id_program AND
                personne.id_group = groupe.id_group";
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

                    // if ($row["id_dependant"] === null) {
                    //     echo "<script> hide(document.getElementById('dependant-list-field')); </script>";
                    // }

                    // CALCUL THE DIFFERENCE BETWEEN TWO DATES
                    // THEN THIS ALGORITHM CHANGE THE STATUT OF THE PERSON
                    // IF THE EXPIRATION DATE AND THE ACTUAL DATE IS EQUAL TO ZERO (0)

                    date_default_timezone_set('America/Port-au-Prince');
                    $actual_date= date('Y-m-d');
                    $date_expiration = $row["date_exp"];
                    
                    $date_diff = date_diff(date_create($date_expiration), date_create($actual_date))->format('%a');

                    if($date_diff == 0){
                        $stmt = $conn->prepare("UPDATE personne SET id_statut = ? WHERE id_person = $id");
                        $new_statut = 2; 
                        $stmt->bind_param('i', $new_statut);
                        $stmt->execute();
                    }elseif($date_diff > 0){
                        $stmt = $conn->prepare("UPDATE personne SET id_statut = ? WHERE id_person = $id");
                        $new_statut = 1; 
                        $stmt->bind_param('i', $new_statut);
                        $stmt->execute();
                    }

                    echo '
                    <div class="profile-img-size mb-3">
                        <img src="../Assets/profile/'; 

                            if(empty($row["profile_image"])){
                                $profile = "profile.png";
                                echo $profile;
                            } else { 
                               $profile=  $row["profile_image"];
                               echo $profile;
                            }

                        echo '" class="profile-img-content" alt="">
                    </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ID Number</label>
                    <input type="text" class="form-control" name="card_number" id="exampleFormControlInput1" value="' . $row["card_number"] . '"'.' readonly required>
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
                <b>Dependant</b> <br>
                <div class="mb-3" id="first-dependant">
                    <label for="exampleFormControlInput1" class="form-label">Dependant 1</label>
                    <input type="text" class="form-control" placeholder="Full name" value="' . $row["nom_1"] . '" name="nom_1" ' . $edit . ' id="exampleFormControlInput1">
                </div>
                <hr>
                <a href="" onclick="second_dependant(); return false" id="s-more" class="float-end nav-link">1 more</a>

                <div class="second-dependant" id="second-dependant">
                    <div class="mb-3" id="second-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 2</label>
                        <input type="text" class="form-control" placeholder="Full name" value="' . $row["nom_2"] . '" name="nom_2" ' . $edit . ' id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="third_dependant(); return false" id="s-more" class="float-end nav-link">1 more</a>
                </div>

                <div class="second-dependant" id="third-dependant">
                    <div class="mb-3" id="third-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 3</label>
                        <input type="text" class="form-control" value="' . $row["nom_3"] . '" placeholder="Full name" ' . $edit . ' name="nom_3" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_4(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_4">
                    <div class="mb-3" id="dependant_4">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 4</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" value="' . $row["nom_4"] . '" name="nom_4" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_5(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_5">
                    <div class="mb-3" id="dependant_5">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 5</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" value="' . $row["nom_5"] . '" name="nom_5" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_6(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_6">
                    <div class="mb-3" id="dependant_6">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 6</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" name="nom_6" value="' . $row["nom_6"] . '" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_7(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_7">
                    <div class="mb-3" id="dependant_7">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 7</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" value="' . $row["nom_7"] . '" name="nom_7" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_8(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_8">
                    <div class="mb-3" id="dependant_8">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 8</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" value="' . $row["nom_8"] . '" name="nom_8" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_9(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_9">
                    <div class="mb-3" id="dependant_9">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 9</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" name="nom_9" value="' . $row["nom_9"] . '" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_10(); return false" id="s-more" class="float-end nav-link"> 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_10">
                    <div class="mb-3" id="dependant_10">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 10</label>
                        <input type="text" class="form-control" ' . $edit . ' placeholder="Full name" value="' . $row["nom_10"] . '" name="nom_10" id="exampleFormControlInput1">
                    </div>
                </div>
                
            </div>';
                    echo $editText;
                }
            }
            echo  '<div class="mb-5"> </div>';
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