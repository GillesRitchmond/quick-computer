<?php
include_once('../../Model/connection.php');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
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
    <title>New user</title>

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
        <div class="title program">
            New user
        </div>
    </div>

    <div class="third-part-content mb-5">
        <div class="container mt-3">
            <span class="title-page-list">
                <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a>  -->
                <a href="index.php" class="nav-link">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                </a>
            </span>
            <hr>
        </div>


        <form action="" method="post" class="container mb-5">
            <div id="alert_message">
                <?php
                if (isset($_POST["submit"])) {
                    try {
                        $nom = $_POST["nom"];
                        $prenom = $_POST["prenom"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $adresse = $_POST["adresse"];
                        $tel_1 = $_POST["tel_1"];
                        $tel_2 = $_POST["tel_2"];
                        $role = $_POST["role"];
                        $id_statut = 1;

                        $code_entreprise = $_SESSION["code_entreprise"];
                        // $code_entreprise = "ckhardware.qc";

                        $h_password = password_hash($password, PASSWORD_DEFAULT);

                        $stmt_user = $conn->prepare("INSERT INTO users (nom, prenom, email, password, adresse, telephone_1, telephone_2, code_entreprise, id_role, id_statut)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt_user->bind_param('ssssssssii', $nom, $prenom, $email, $h_password, $adresse, $tel_1, $tel_2, $code_entreprise, $role, $id_statut);

                        if ($stmt_user->execute()) {
                            echo '<div class="alert alert-success" role="alert">
                            Enregistrement réussi !
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
            <div class="mb-3">
                <label for="code_entreprise" class="form-label">Code enterprise</label>
                <select id="code_entreprise" name="code_entreprise" class="form-select" required>

                    <?php

                    $query = "SELECT * FROM entreprise ORDER BY id_ent DESC ";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row["code_entreprise"] . '">' . $row["nom_entreprise"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleFormControlInput1" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telephone 1</label>
                <input type="number" class="form-control" name="tel_1" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telephone 2</label>
                <input type="number" class="form-control" name="tel_2" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select" required>

                    <?php

                    $query = "SELECT * FROM role ORDER BY role_name ASC ";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row["id_role"] . '">' . $row["role_name"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>


            <button type="submit" name="submit" class="text-white mb-5 btn btn-brand">Save user</button>
        </form>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

</html>