<?php
include_once('../../Model/connection.php');
session_start();
// && 
//     isset($_SESSION["role"]) && $_SESSION["role"] !== 4
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
    <title>Admin Dashboard</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="../css/style.css">


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
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet"> -->

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
    <br><br>
    <div class="container mt-5">

        <h2>Mina Dashboard</h2>
        <hr class="hr">
        <div class="top"></div>

        <div class="admin">
            <ul>
                <li><a href="add-enterprise.php" class="btn btn-outline-primary">New enterprise</a></li>
                <li><a href="user-to-enterprise.php" class="btn btn-outline-secondary">New user</a></li>
            </ul>
            <div class="mt-3">
                <ul>
                    <li><a class="nav-link" href="" onclick="loadEnterprises(); return false;">Enterprises |</a></li>
                    <li><a class="nav-link" href="" onclick="loadPrograms(); return false;">Programs |</a></li>
                    <li><a class="nav-link" href="" onclick="loadGroups(); return false;">Groups |</a></li>
                    <li><a class="nav-link" href="" onclick="loadPersons(); return false;">Persons |</a></li>
                    <li><a class="nav-link" href="" onclick="loadUsers(); return false;">Users</a></li>
                </ul>
            </div>
        </div>

        <div id="loadEnterprise">
            <div class="table-responsive mt-5 mb-5">

                <table id="data-enterprise" class="display nowrap stripe order-column cell-border" style="width:100%">


                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Enterprise</th>
                                    <th>Creation date</th>
                                    <th>Expiration date</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>';

                        $query = "SELECT * FROM entreprise, statut WHERE entreprise.statut_id = statut.id_statut";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                            <td>' . $row['code_entreprise'] . '</td>
                            <td>' . $row['nom_entreprise'] . '</td>
                            <td>' . $row['date_creation'] . '</td>
                            <td>' . $row['date_expiration'] . '</td>
                            <td>' . $row['statut_name'] . '</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2"><a href="view-enterprise.php?view-entreprise='.$row["id_ent"].'" class="nav-link text-success"><i class="bi bi-eye"></i></a></div>
                                    <div class="col-md-2"><a href="view-enterprise.php?edit-entreprise='.$row["id_ent"].'" class="nav-link"><i class="bi bi-pencil-square"></i></a></div>
                                    <div class="col-md-2"><a class="nav-link"></a></div>
                                </div>
                            </td>
                        </tr>';
                            }
                        }
                        echo '</tbody>';
                    }

                    ?>
                </table>


            </div>
        </div>

        <div id="loadProgram">
            <div class="table-responsive mt-5 mb-5">

                <table id="data-program" class="display nowrap stripe order-column cell-border" style="width:100%">


                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Enterprise</th>
                                    <th>Creation date</th>
                                    <th>Expiration date</th>
                                </tr>
                            </thead>
                        <tbody>';

                        $query = "SELECT program_name, nom_entreprise, program.date_creation as date_creation, program.date_expiration as date_expiration
                        FROM entreprise, program WHERE entreprise.code_entreprise = program.code_entreprise";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                            <td>' . $row['program_name'] . '</td>
                            <td>' . $row['nom_entreprise'] . '</td>
                            <td>' . $row['date_creation'] . '</td>
                            <td>' . $row['date_expiration'] . '</td>
                        </tr>';
                            }
                        }
                        echo '</tbody>';
                    }

                    ?>
                </table>


            </div>
        </div>

        <div id="loadGroup">
            <div class="table-responsive mt-5 mb-5">

                <table id="data-group" class="display nowrap stripe order-column cell-border table-s" style="width:100%">


                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th>Group</th>
                                    <th>Program</th>
                                    <th>Enterprise</th>
                                </tr>
                            </thead>
                        <tbody>';

                        $query = "SELECT * FROM groupe, program, entreprise WHERE 
                            entreprise.code_entreprise = program.code_entreprise AND groupe.id_program = program.id_program";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                            <td>' . $row["nom_groupe"] . '</td>
                            <td>' . $row["program_name"] . '</td>
                            <td>' . $row['nom_entreprise'] . '</td>
                        </tr>';
                            }
                        }
                        echo '</tbody>';
                    }

                    ?>
                </table>


            </div>
        </div>

        <div id="loadPerson">
            <div class="table-responsive mt-5 mb-5">

                <table id="data-person" class="display nowrap stripe order-column cell-border" style="width:100%">


                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th>ID number</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Group</th>
                                    <th>Program</th>
                                    <th>Enterprise</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                        <tbody>';

                        $query = "SELECT * FROM personne, groupe, program, entreprise, statut WHERE
                                entreprise.code_entreprise = program.code_entreprise AND program.id_program = groupe.id_program
                                AND program.id_program = personne.id_program AND personne.id_group = groupe.id_group AND statut.id_statut = personne.id_statut";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                            <td>' . $row["card_number"] . '</td>
                            <td>' . $row['nom'] . '</td>
                            <td>' . $row['prenom'] . '</td>
                            <td>' . $row['nom_groupe'] . '</td>
                            <td>' . $row['program_name'] . '</td>
                            <td>' . $row["code_entreprise"] . '</td>
                            <td>' . $row['statut_name'] . '</td>
                        </tr>';
                            }
                        }
                        echo '</tbody>';
                    }

                    ?>
                </table>


            </div>
        </div>

        <div id="loadUser">
            <div class="table-responsive mt-5 mb-5">

                <table id="data-user" class="display nowrap stripe order-column cell-border" style="width:100%">


                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Adress</th>
                                    <th>Phone 1</th>
                                    <th>Phone 2</th>
                                    <th>Role</th>
                                    <th>Statut</th>
                                    <th>Enterprise</th>
                                </tr>
                            </thead>
                        <tbody>';

                        $query = "SELECT * FROM users, entreprise, role, statut WHERE entreprise.code_entreprise = users.code_entreprise
                        AND users.id_role = role.id_role AND users.id_statut = statut.id_statut";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                            <td>' . $row['nom'] . '</td>
                            <td>' . $row['prenom'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['adresse'] . '</td>
                            <td>' . $row["telephone_1"] . '</td>
                            <td>' . $row["telephone_2"] . '</td>
                            <td>' . $row["role_name"] . '</td>
                            <td>' . $row['statut_name'] . '</td>
                            <td>' . $row["nom_entreprise"] . '</td>
                        </tr>';
                            }
                        }
                        echo '</tbody>';
                    }

                    ?>
                </table>


            </div>
        </div>
    </div>
    <!-- </div>
    </div> -->

</body>

<script>
    show(document.getElementById('loadEnterprise'));
    hide(document.getElementById('loadProgram'));
    hide(document.getElementById('loadGroup'));
    hide(document.getElementById('loadPerson'));
    hide(document.getElementById('loadUser'));

    $(document).ready(function() {
        $('#data-enterprise').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ]
        });
    });

    function loadEntreprises() {
        show(document.getElementById('loadEnterprise'));
        hide(document.getElementById('loadProgram'));
        hide(document.getElementById('loadGroup'));
        hide(document.getElementById('loadPerson'));
        hide(document.getElementById('loadUser'));

        $(document).ready(function() {
            $('#data-enterprise').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ]
            });
        });
    }

    function loadPrograms() {
        hide(document.getElementById('loadEnterprise'));
        show(document.getElementById('loadProgram'));
        hide(document.getElementById('loadGroup'));
        hide(document.getElementById('loadPerson'));
        hide(document.getElementById('loadUser'));

        $(document).ready(function() {
            $('#data-program').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ]
            });
        });
    }


    function loadGroups() {
        hide(document.getElementById('loadEnterprise'));
        hide(document.getElementById('loadProgram'));
        show(document.getElementById('loadGroup'));
        hide(document.getElementById('loadPerson'));
        hide(document.getElementById('loadUser'));

        $(document).ready(function() {
            $('#data-group').DataTable({
                dom: 'Bfrtip',
                buttons: [
                   'excel',
                ]
            });
        });
    }

    function loadPersons() {
        hide(document.getElementById('loadEnterprise'));
        hide(document.getElementById('loadProgram'));
        hide(document.getElementById('loadGroup'));
        show(document.getElementById('loadPerson'));
        hide(document.getElementById('loadUser'));

        $(document).ready(function() {
            $('#data-person').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ]
            });
        });
    }

    function loadUsers() {
        hide(document.getElementById('loadEnterprise'));
        hide(document.getElementById('loadProgram'));
        hide(document.getElementById('loadGroup'));
        hide(document.getElementById('loadPerson'));
        show(document.getElementById('loadUser'));

        $(document).ready(function() {
            $('#data-user').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ]
            });
        });
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