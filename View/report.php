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
    <title>Settings</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">


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

</head>

<body class="body">
    <?php
    include_once('header.php');
    ?>
    <?php
    echo '<div class="settings-content">
        <h2>About user</h2>
        <div class="mt-5 bg-white">
            <div class="profile">';

    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $code_entreprise = $_SESSION["code_entreprise"];

    $query = "SELECT * FROM entreprise, users, role, statut WHERE users.code_entreprise = '$code_entreprise' AND
                 entreprise.code_entreprise = '$code_entreprise' AND users.id_role = role.id_role AND statut.id_statut = users.id_statut AND nom like '%$nom%' AND prenom LIKE '%$prenom%'";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="img-content">
                            
                        </div>


                        <div class="account-infos">
                            <div class="user-name">' . $row["nom"] . ' ' . $row["prenom"] . '</div>
                            <ul>
                                <li>Email : <span class="result">' . $row["email"] . '</span></li>
                                <li>Address : <span class="result">' . $row["adresse"] . '</span></li>
                                <li>Phone: <span class="result">' . $row["telephone_1"] . '</span></li>
                                <li>Role : <span class="result">' . $row["role_name"] . '</span></li>
                                <li>Statut : <span class="result">' . $row["statut_name"] . '</span></li>
                            </ul>
                        </div>';
        }
    }

    echo '</div>
        </div>
    </div>

    <div class="statistic">
        
        <!-- <div class="top"></div> -->
        <div class="bg-white mb-5">
        <span class="title-page-list">
            <a> Your records </a>
        </span>
        <hr>
            <div class=" mt-3 bg-blue">
                <div class="data_1">
                    <div class="data-content">
                        <ul>';

    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $code_entreprise = $_SESSION["code_entreprise"];

    $query = "SELECT count(program.id_program) AS qty_program FROM entreprise, users, program WHERE users.code_entreprise = '$code_entreprise' AND
                 entreprise.code_entreprise = '$code_entreprise' AND program.code_user = users.code_user AND nom like '%$nom%' AND prenom LIKE '%$prenom%'";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="data-title">Qty of program created by you :</li>
                <li class="data-qty">' . $row["qty_program"] . '</li>
                <li class="data-hint">Make report every weeks to control your programs</li>';
        }
    }
    echo '</ul>
                    </div>
                </div>
            </div>
            <div class="bg-yellow">
                <div class="data_2">
                    <div class="data-content">
                        <ul>';

    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $code_entreprise = $_SESSION["code_entreprise"];

    $query = "SELECT count(groupe.id_group) AS qty_group FROM entreprise, users, program, groupe WHERE users.code_entreprise = '$code_entreprise' AND
             entreprise.code_entreprise = '$code_entreprise' AND program.code_user = users.code_user AND program.id_program = groupe.id_program AND
             users.code_user = groupe.code_user AND nom like '%$nom%' AND prenom LIKE '%$prenom%'";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="data-title">Qty of group created by you:</li>
                <li class="data-qty">' . $row["qty_group"] . '</li>
                <li class="data-hint">Make report to get the an idea about a group</li>';
        }
    }
    echo '</ul>
                    </div>
                </div>
            </div>
            <div class="bg-green">
                <div class="data_3">
                    <div class="data-content">
                        <ul>';

    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $code_entreprise = $_SESSION["code_entreprise"];

    $query = "SELECT count(personne.id_person) AS qty_personne FROM personne, groupe, users, program WHERE users.code_entreprise = '$code_entreprise' AND
             program.code_user = users.code_user AND personne.id_group = groupe.id_group AND program.id_program = personne.id_program ";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="data-title">Qty of person added by the team:</li>
                <li class="data-qty">'.$row["qty_personne"].'</li>
                <li class="data-hint">Make report to make a better management of the persons list</li>';
        }
    }
    echo '</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    ?>


    <?php
    include_once('sidebar.php');
    include_once('footer.php');
    ?>
</body>

<script>
    function main() {
        show(document.getElementById('main'));
    }

    function close() {
        hide(document.getElementById('main'));
    }

    hide(document.getElementById('main'));

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