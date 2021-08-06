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
    <title>Create badge</title>

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
    <div class="header-content">

        <?php
        // $id = $_GET['group-details'];
        // $query = "SELECT * FROM users, program, groupe WHERE users.code_user = program.code_user AND groupe.id_program = program.id_program AND id_group = $id LIMIT 1";
        // $result = $conn->query($query);
        // if (mysqli_num_rows($result) > 0) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        // echo '<div class="title">' . $row["nom_groupe"] . '</div>
        //     <span class="subtitle">Created : ' . $row["date_creation"] . '</span>';

        echo '<div class="title">Create badge</div>';
        //     }
        // }
        ?>
    </div>

    <div class="container mt-3">
        <span class="title-page-list">
            <!-- <a href="index.php"><i class="bi bi-arrow-left-short fs-1"></i></a>  -->
            <?php
            $id = $_GET['group-details'];
            // $code_entreprise = $_SESSION["code_entreprise"];

            $query = "SELECT * FROM groupe WHERE id_group = $id";
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

    <form action="print.php" method="GET">
        <div class="container table-responsive mt-5">

            <table id="data-student" class="display nowrap stripe order-column cell-border" style="width:100%">


                <?php
                if (isset($_GET["group-details"])) {
                    
                    echo '<thead>
                            <tr>
                                <th></th>
                                <th>ID Number</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Birth date</th>
                                <th>Birth place</th>
                                <th>Phone 1</th>
                                <th>Phone 2</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Program</th>
                                <th>Prog. image</th>
                                <th>Profile image</th>
                                <th>Creation date</th>
                                <th>Exp. date</th>
                                <th>Created by</th>
                            </tr>
                        </thead>
                    <tbody>';

                    $code_entreprise = $_SESSION["code_entreprise"];
                    $id_group = $_GET["group-details"];


                    $query = "SELECT id_person, card_number, personne.nom as personne_nom, personne.prenom as personne_prenom, date_naissance, lieu_naissance,
                    personne.telephone_1 as telephone_1, personne.telephone_2 as telephone_2, personne.adresse as adresse, personne.email as email, 
                    statut_name, program_name, program.image as image, personne.profile_image as profile_image, personne.creation_date as date_creation,
                    personne.date_exp as date_expiration, users.nom as user_nom, users.prenom as user_prenom
                FROM entreprise, program, users, groupe, personne, statut 
                WHERE entreprise.code_entreprise = '$code_entreprise' AND 
                    program.code_entreprise = '$code_entreprise' AND users.code_entreprise = '$code_entreprise' AND users.code_user = program.code_user 
                    AND users.code_user = groupe.code_user AND program.id_program = groupe.id_program AND
                    personne.id_program = program.id_program AND personne.id_group = groupe.id_group AND personne.id_group = '$id_group' AND 
                    groupe.id_group = '$id_group' AND statut.id_statut = personne.id_statut
                ORDER BY personne_nom ASC";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="toPrint[]" multiple value="'.$row["id_person"].'" id="flexSwitchCheckChecked">
                                </td>
                                <td>' . $row['card_number'] . '</td>
                                <td>' . $row['personne_nom'] . '</td>
                                <td>' . $row['personne_prenom'] . '</td>
                                <td>' . $row['date_naissance'] . '</td>
                                <td>' . $row['lieu_naissance'] . '</td>
                                <td>' . $row['telephone_1'] . '</td>
                                <td>' . $row['telephone_2'] . '</td>
                                <td>' . $row['adresse'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['statut_name'] . '</td>
                                <td>' . $row['program_name'] . '</td>
                                <td>' . $row['image'] . '</td>
                                <td>' . $row['profile_image'] . '</td>
                                <td>' . $row['date_creation'] . '</td>
                                <td>' . $row['date_expiration'] . '</td>
                                <td>' . $row['user_nom'] . ' ' . $row['user_prenom'] . '</td>
                            </tr>';
                        }
                    }
                    echo '</tbody>';
                }
                ?>
            </table>
        </div>

        <div class="mt-3 container badge-button">
            <button type="submit" class="col-md-4 btn btn-primary">Generate badge</button>
        </div>

    </form>

    <div class="mb-5">
        <span>
            <p>
                <br>
                <br>
            </p>
        </span>
    </div>



    <?php
    // include_once('sidebar.php');
    include_once('footer.php');
    ?>
</body>

<script>
    $(document).ready(function() {
        $('#data-student').DataTable({
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

</html>