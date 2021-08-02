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
    <title>Add person</title>

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
        <div class="title program">
            New person
        </div>
    </div>

    <div class="third-part-content mb-5">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a>  -->
                <?php
                $id = $_GET["group-details"];
                // $code_entreprise = $_SESSION["code_entreprise"];

                $query = "SELECT * FROM program, groupe WHERE groupe.id_group = $id AND groupe.id_program = program.id_program";
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


        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="container mb-5">
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
                        $id_statut = $_POST["id_statut"];
                        $nom_1 = $_POST["nom_1"];
                        $nom_2 = $_POST["nom_2"];
                        $nom_3 = $_POST["nom_3"];
                        $nom_4 = $_POST["nom_4"];
                        $nom_5 = $_POST["nom_5"];
                        $nom_6 = $_POST["nom_6"];
                        $nom_7 = $_POST["nom_7"];
                        $nom_8 = $_POST["nom_8"];
                        $nom_9 = $_POST["nom_9"];
                        $nom_10 = $_POST["nom_10"];
                        date_default_timezone_set('America/Port-au-Prince');
                        $actual_date= date('Y-m-d');
                        $date_expiration = $_POST["date_exp"];
                        $id_dependant = 0;
                        // $code_entreprise = $_SESSION["code_entreprise"];
                        // $code_entreprise = "ckhardware.qc";

                        // $h_password = password_hash($password, PASSWORD_DEFAULT);
                        $file_name = $_FILES['fileToUpload']['name'];
                        $file = rand(1000, 100000) . "-" . $file_name;
                        $file_loc = $_FILES['fileToUpload']['tmp_name'];
                        $file_size = $_FILES['fileToUpload']['size'];
                        $file_type = $_FILES['fileToUpload']['type'];
                        $folder = "../Assets/profile/";

                        /* new file size in KB */
                        $new_size = $file_size / 1024;
                        /* new file size in KB */

                        /* make file name in lower case */
                        $new_file_name = strtolower($file);
                        /* make file name in lower case */

                        $final_file = str_replace(' ', '-', $new_file_name);


                        if(isset($_POST["fileToUpload"]))
                        {
                            if (move_uploaded_file($file_loc, $folder . $final_file)) {
                                $stmt_user = $conn->prepare("INSERT INTO personne (nom, prenom, date_naissance, lieu_naissance, telephone_1, telephone_2, 
                                            adresse, email, profile_image, date_exp, creation_date, id_statut, id_dependant, id_group, id_program)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt_user->bind_param(
                                    'sssssssssssiiii',
                                    $nom,
                                    $prenom,
                                    $date_naissance,
                                    $lieu_naissance,
                                    $tel_1,
                                    $tel_2,
                                    $adresse,
                                    $email,
                                    $final_file,
                                    $date_expiration,
                                    $actual_date,
                                    $id_statut,
                                    $id_dependant,
                                    $id_group,
                                    $id_program
                                );
    
                                $stmt_dependant = $conn->prepare("INSERT INTO dependant (nom_1, nom_2, nom_3, nom_4, nom_5, nom_6, nom_7, nom_8, nom_9, nom_10)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt_dependant->bind_param(
                                    'ssssssssss',
                                    $nom_1,
                                    $nom_2,
                                    $nom_3,
                                    $nom_4,
                                    $nom_5,
                                    $nom_6,
                                    $nom_7,
                                    $nom_8,
                                    $nom_9,
                                    $nom_10
                                );
    
                                if ($stmt_user->execute() && $stmt_dependant->execute()) {
    
                                    if(!empty(isset($nom_1)) || !empty(isset($nom_2)) || !empty(isset($nom_3)) || !empty(isset($nom_4)) || !empty(isset($nom_5)) || !empty(isset($nom_6)) ||
                                    !empty(isset($nom_7)) || !empty(isset($nom_8)) || !empty(isset($nom_9)) || !empty(isset($nom_10)))
                                    {
                                        $query = "SELECT dependant.id_dependant as dependant, personne.id_dependant as personne, id_person FROM dependant, personne 
                                                    WHERE personne.id_dependant = 0 ORDER BY dependant.id_dependant DESC, personne.id_person DESC LIMIT 1";
                                        $result =$conn->query($query);
    
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $dependant = $row["dependant"];
                                                // $personne = $row["personne"];
                                                $id_person = $row["id_person"];
    
                                                $stmt = $conn->prepare("UPDATE personne SET personne.id_dependant = ? WHERE id_person = $id_person");
                                                $stmt->bind_param('i', $dependant);
                                                $stmt->execute();
                                            }
                                        }
                                    }
                                    echo '<div class="alert alert-success" role="alert">
                                    Saved successfully !
                                    </div>';
                                }
                            }
                        }else{
                                $stmt_user = $conn->prepare("INSERT INTO personne (nom, prenom, date_naissance, lieu_naissance, telephone_1, telephone_2, 
                                            adresse, email, date_exp, creation_date, id_statut, id_dependant, id_group, id_program)
                                            VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt_user->bind_param(
                                    'ssssssssssiiii',
                                    $nom,
                                    $prenom,
                                    $date_naissance,
                                    $lieu_naissance,
                                    $tel_1,
                                    $tel_2,
                                    $adresse,
                                    $email,
                                    $date_expiration,
                                    $actual_date,
                                    $id_statut,
                                    $id_dependant,
                                    $id_group,
                                    $id_program
                                );
    
                                $stmt_dependant = $conn->prepare("INSERT INTO dependant (nom_1, nom_2, nom_3, nom_4, nom_5, nom_6, nom_7, nom_8, nom_9, nom_10)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt_dependant->bind_param(
                                    'ssssssssss',
                                    $nom_1,
                                    $nom_2,
                                    $nom_3,
                                    $nom_4,
                                    $nom_5,
                                    $nom_6,
                                    $nom_7,
                                    $nom_8,
                                    $nom_9,
                                    $nom_10
                                );
    
                                if ($stmt_user->execute() && $stmt_dependant->execute()) {
    
                                    if(!empty(isset($nom_1)) || !empty(isset($nom_2)) || !empty(isset($nom_3)) || !empty(isset($nom_4)) || !empty(isset($nom_5)) || !empty(isset($nom_6)) ||
                                    !empty(isset($nom_7)) || !empty(isset($nom_8)) || !empty(isset($nom_9)) || !empty(isset($nom_10)))
                                    {
                                        $query = "SELECT dependant.id_dependant as dependant, personne.id_dependant as personne, id_person FROM dependant, personne 
                                                    WHERE personne.id_dependant = 0 ORDER BY dependant.id_dependant DESC, personne.id_person DESC LIMIT 1";
                                        $result =$conn->query($query);
    
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $dependant = $row["dependant"];
                                                // $personne = $row["personne"];
                                                $id_person = $row["id_person"];
    
                                                $stmt = $conn->prepare("UPDATE personne SET personne.id_dependant = ? WHERE id_person = $id_person");
                                                $stmt->bind_param('i', $dependant);
                                                $stmt->execute();
                                            }
                                        }
                                    }
                                    echo '<div class="alert alert-success" role="alert">
                                    Saved successfully !
                                    </div>';
                                }
                            }
                        // }
                        // if (move_uploaded_file($file_loc, $folder . $final_file)) {
                        //     $stmt_user = $conn->prepare("INSERT INTO personne (nom, prenom, date_naissance, lieu_naissance, telephone_1, telephone_2, 
                        //                 adresse, email, profile_image, date_exp, creation_date, id_statut, id_dependant, id_group, id_program)
                        //                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        //     $stmt_user->bind_param(
                        //         'sssssssssssiiii',
                        //         $nom,
                        //         $prenom,
                        //         $date_naissance,
                        //         $lieu_naissance,
                        //         $tel_1,
                        //         $tel_2,
                        //         $adresse,
                        //         $email,
                        //         $final_file,
                        //         $date_expiration,
                        //         $actual_date,
                        //         $id_statut,
                        //         $id_dependant,
                        //         $id_group,
                        //         $id_program
                        //     );

                        //     $stmt_dependant = $conn->prepare("INSERT INTO dependant (nom_1, nom_2, nom_3, nom_4, nom_5, nom_6, nom_7, nom_8, nom_9, nom_10)
                        //                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        //     $stmt_dependant->bind_param(
                        //         'ssssssssss',
                        //         $nom_1,
                        //         $nom_2,
                        //         $nom_3,
                        //         $nom_4,
                        //         $nom_5,
                        //         $nom_6,
                        //         $nom_7,
                        //         $nom_8,
                        //         $nom_9,
                        //         $nom_10
                        //     );

                        //     if ($stmt_user->execute() && $stmt_dependant->execute()) {

                        //         if(!empty(isset($nom_1)) || !empty(isset($nom_2)) || !empty(isset($nom_3)) || !empty(isset($nom_4)) || !empty(isset($nom_5)) || !empty(isset($nom_6)) ||
                        //         !empty(isset($nom_7)) || !empty(isset($nom_8)) || !empty(isset($nom_9)) || !empty(isset($nom_10)))
                        //         {
                        //             $query = "SELECT dependant.id_dependant as dependant, personne.id_dependant as personne, id_person FROM dependant, personne 
                        //                         WHERE personne.id_dependant = 0 ORDER BY dependant.id_dependant DESC, personne.id_person DESC LIMIT 1";
                        //             $result =$conn->query($query);

                        //             if (mysqli_num_rows($result) > 0) {
                        //                 while ($row = mysqli_fetch_assoc($result)) {
                        //                     $dependant = $row["dependant"];
                        //                     // $personne = $row["personne"];
                        //                     $id_person = $row["id_person"];

                        //                     $stmt = $conn->prepare("UPDATE personne SET personne.id_dependant = ? WHERE id_person = $id_person");
                        //                     $stmt->bind_param('i', $dependant);
                        //                     $stmt->execute();
                        //                 }
                        //             }
                        //         }
                        //         echo '<div class="alert alert-success" role="alert">
                        //         Saved successfully !
                        //         </div>';
                        //     }
                        // }
                    } catch (PDOException $e) {

                        echo '<div class="alert alert-danger" role="alert">
                        Failed registration  !
                        </div>';
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email <span class="details">(Optionnal)</span></label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Birth date</label>
                <input type="date" class="form-control" name="date" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Birth place</label>
                <input type="text" class="form-control" name="lieu" id="exampleFormControlInput1" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone 1</label>
                <input type="number" class="form-control" name="tel_1" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone 2 <span class="details">(Optionnal)</span></label>
                <input type="number" class="form-control" name="tel_2" id="exampleFormControlInput1">
            </div>
            <div class="mb-3 form_field">
                <label for="fileSelect">Profile picture:</label>
                <input type="file" name="fileToUpload" class="form-control-file">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Expiration date</label>
                <input type="date" class="form-control" name="date_exp" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">

                <div class="form-check form-switch">
                    <input class="form-check-input" type="hidden" name="id_statut" value="2" id="flexSwitchCheckChecked">
                    <input class="form-check-input" type="checkbox" name="id_statut" value="1" checked id="flexSwitchCheckChecked">
                    <label class="form-check-label" for="flexCheckDefault">
                        Enable <span class="details">(Default : Enable)</span>
                    </label>
                </div>

                <!-- <div class="form-check">
                    <input class="form-check-input" type="hidden" name="id_statut" value="2" id="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" name="id_statut" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Activate <span class="details">(Check it to activate this person in the program)</span>
                    </label>
                </div> -->
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <a class="" onclick="dependant(); return false;"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" ondblclick="hide_dependant(); return false" onclick="dependant(); return false;"></a>
                    <label class="form-check-label" for="flexCheckDefault">
                        Add Dependant <span class="details">(Optionnal)</span>
                    </label>
                </div>
            </div>
            <div class="dependant" id="dependant-list-field">
                <label class="form-label">Information about dependant(s)</label>
                <hr>
                <b>Dependant</b> <br>
                <div class="mb-3" id="first-dependant">
                    <label for="exampleFormControlInput1" class="form-label">Dependant 1</label>
                    <input type="text" class="form-control" placeholder="Full name" name="nom_1" id="exampleFormControlInput1">
                </div>
                <hr>
                <a href="" onclick="second_dependant(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>

                <div class="second-dependant" id="second-dependant">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="second-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 2</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_2" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="third_dependant(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="third-dependant">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="third-dependant">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 3</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_3" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_4(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_4">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_4">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 4</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_4" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_5(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_5">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_5">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 5</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_5" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_6(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_6">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_6">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 6</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_6" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_7(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_7">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_7">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 7</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_7" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_8(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_8">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_8">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 8</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_8" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_9(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_9">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_9">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 9</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_9" id="exampleFormControlInput1">
                    </div>
                    <hr>
                    <a href="" onclick="dependant_10(); return false" id="s-more" class="float-end nav-link">Add 1 more</a>
                </div>

                <div class="second-dependant" id="dependant_10">
                    <!-- <b>Second dependant</b> <br> -->
                    <div class="mb-3" id="dependant_10">
                        <label for="exampleFormControlInput1" class="form-label">Dependant 10</label>
                        <input type="text" class="form-control" placeholder="Full name" name="nom_10" id="exampleFormControlInput1">
                    </div>
                </div>
                
            </div>
            <button type="submit" name="submit" class="text-white mb-5 btn btn-brand">Save person</button>
        </form>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

<script>
    hide(document.getElementById('dependant-list-field'));

    function dependant() {
        show(document.getElementById('dependant-list-field'));
        hide(document.getElementById('second-dependant'));
        hide(document.getElementById('third-dependant'));
        hide(document.getElementById('dependant_4'));
        hide(document.getElementById('dependant_5'));
        hide(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function second_dependant() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        hide(document.getElementById('third-dependant'));
        hide(document.getElementById('dependant_4'));
        hide(document.getElementById('dependant_5'));
        hide(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));

    }

    function third_dependant() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        hide(document.getElementById('dependant_4'));
        hide(document.getElementById('dependant_5'));
        hide(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }
    
    function dependant_4() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        hide(document.getElementById('dependant_5'));
        hide(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_5() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        hide(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_6() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        show(document.getElementById('dependant_6'));
        hide(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_7() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        show(document.getElementById('dependant_6'));
        show(document.getElementById('dependant_7'));
        hide(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_8() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        show(document.getElementById('dependant_6'));
        show(document.getElementById('dependant_7'));
        show(document.getElementById('dependant_8'));
        hide(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_9() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        show(document.getElementById('dependant_6'));
        show(document.getElementById('dependant_7'));
        show(document.getElementById('dependant_8'));
        show(document.getElementById('dependant_9'));
        hide(document.getElementById('dependant_10'));
    }

    function dependant_10() {
        show(document.getElementById('dependant-list-field'));
        show(document.getElementById('second-dependant'));
        show(document.getElementById('third-dependant'));
        show(document.getElementById('dependant_4'));
        show(document.getElementById('dependant_5'));
        show(document.getElementById('dependant_6'));
        show(document.getElementById('dependant_7'));
        show(document.getElementById('dependant_8'));
        show(document.getElementById('dependant_9'));
        show(document.getElementById('dependant_10'));
    }

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