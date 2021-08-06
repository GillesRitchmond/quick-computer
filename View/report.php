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
    <title>Report Data</title>

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

    <!-- DATATABLES.NET -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
</head>

<body class="body">
    <?php
    include_once('header.php');
    ?>


    <div class="report">
        <div class="bg-primary-color">
            <div class="content-report">
                <div class="title-report">
                    <span class="hint-color-muted">Export your data </span>
                    is very simple with Mina !
                </div>
            </div>
        </div>
        <div class="report-action">
            <div class="bg-white-top">
                <a href="index.php" class="nav-link">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                    <hr>
                </a>

                <ul class="mb-5">
                    <li>
                        <div class="choose-action">
                            <ul>
                                <li>
                                    <form action="data-report.php" method="POST">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label">Export by program</label>
                                                <select id="role" name="id_program" class="form-select" required>

                                                    <?php
                                                    $code_entreprise = $_SESSION["code_entreprise"];
                                                    $query = "SELECT * FROM program, entreprise WHERE program.code_entreprise = '$code_entreprise' AND entreprise.code_entreprise = '$code_entreprise' ORDER BY program_name ASC ";
                                                    $result = $conn->query($query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row["id_program"] . '">' . $row["program_name"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="program" class="col-md-4 btn btn-brand">Export by program</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="choose-action">
                            <ul>
                                <li>
                                    <form action="data-report.php" method="POST">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label">Export by group</label>
                                                <select id="role" name="id_group" class=" form-select" required>

                                                    <?php
                                                    $nom = $_SESSION["nom"];
                                                    $prenom = $_SESSION["prenom"];
                                                    $code_entreprise = $_SESSION["code_entreprise"];
                                                    $query = "SELECT * FROM groupe, entreprise, program WHERE 
                                                    entreprise.code_entreprise = program.code_entreprise AND entreprise.code_entreprise = '$code_entreprise' 
                                                    AND program.code_entreprise = '$code_entreprise' AND groupe.id_program = program.id_program 
                                                    ORDER BY nom_groupe ASC ";
                                                    $result = $conn->query($query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row["id_group"] . '">' . $row["nom_groupe"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="group" class="col-md-4 btn btn-brand">Export by group</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="choose-action">
                            <ul>
                                <li>
                                    <form action="data-report.php" method="POST">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label">Export by person</label>
                                                <select id="role" name="id_person" class="form-select" required>

                                                    <?php
                                                    $nom = $_SESSION["nom"];
                                                    $prenom = $_SESSION["prenom"];
                                                    $code_entreprise = $_SESSION["code_entreprise"];
                                                    $query = "SELECT personne.id_person as id_person, personne.nom as nom, personne.prenom as prenom 
                                                    FROM personne, program, entreprise WHERE entreprise.code_entreprise = '$code_entreprise' AND 
                                                    program.code_entreprise = '$code_entreprise' AND program.id_program = personne.id_program ";
                                                    $result = $conn->query($query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row["id_person"] . '">' . $row["nom"] . ' ' . $row["prenom"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="person" class="col-md-4 btn btn-brand">Export by person</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="full">
                            <span class="btn btn-brand col-md"> </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    <?php
    // include_once('sidebar.php');
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