<?php
include_once('../../Model/connection.php');
session_start();
// && 
//     isset($_SESSION["role"]) && $_SESSION["role"] !== 4
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ) {
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
    <div class="container mt-5">
        
        <h2>Mina Dashboard</h2>
        <hr>

        <div class="admin">
            <ul>
                <li><a href="add-enterprise.php" class="btn btn-outline-primary">New enterprise</a></li>
                <li><a href="user-to-enterprise.php" class="btn btn-outline-secondary">New user</a></li>
            </ul>
        </div>

        <div class="table-responsive mt-5 mb-5">

                <table id="data-student" class="display nowrap stripe order-column cell-border" style="width:100%">
                    

                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === 4) {
                        echo '<thead>
                                <tr>
                                    <th></th>
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
                            while($row = mysqli_fetch_assoc($result)) {
                               echo '<tr>
                                        <td>'.$row["id_ent"].'</td>
                                        <td>'.$row['code_entreprise'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['date_creation'].'</td>
                                        <td>'.$row['date_expiration'].'</td>
                                        <td>'.$row['statut_name'].'</td>
                                        <td>
                                                    <div class="row">
                                                        <div class="col-md-2"><a href="" class="nav-link text-success"><i class="bi bi-eye"></i></a></div>
                                                        <div class="col-md-2"><a href="" class="nav-link"><i class="bi bi-pencil-square"></i></a></div>
                                                        <div class="col-md-2"><a href="" class="nav-link text-danger"><i class="bi bi-trash"></i></a></div>
                                                    </div>
                                                </td>
                                    </tr>';
                            }
                        }
                    }
                    // elseif(isset($_SESSION["role"]) && $_SESSION["role"] === 6 && isset($_SESSION["class_id"]) && isset($_SESSION["classroom_id"])){

                    //     echo '<thead>
                    //     <tr>
                    //         <th>Code</th>
                    //         <th>Nom</th>
                    //         <th>Prénom</th>
                    //         <th>Classe</th>
                    //     </tr>
                    // </thead>
                    // <tbody>';
                    //     $id_class = $_SESSION["class_id"];
                    //     $id_classroom = $_SESSION["classroom_id"];
                        
                    //     $query = "SELECT * FROM user, user_infos, class WHERE id_role = 6 AND user.code = user_infos.user_identifiant_code AND 
                    //                 user_infos.class_id = $id_class AND class.id_class = $id_class AND user_infos.classroom_id = $id_classroom";
                    //     $result = $conn->query($query);

                    //     if (mysqli_num_rows($result) > 0) {
                    //         while($row = mysqli_fetch_assoc($result)) {
                    //            echo '<tr>
                    //                     <td>'.$row['code'].'</td>
                    //                     <td>'.$row['lastName'].'</td>
                    //                     <td>'.$row['firstName'].'</td>
                    //                     <td>'.$row['class_name'].'</td>
                    //                 </tr>';
                    //         }
                    //     }

                    // }
                    
                    ?>
                      
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> -->
                </table>


            </div>
        </div>
    </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        $('#data-student').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

</html>