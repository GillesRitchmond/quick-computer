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
    <title>Print badge</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/card.css">



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

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Generate PDF -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
    <!-- <script src="pdf.js"></script> -->

    <!-- <script src="html2pdf.bundle.min.js"></script> -->

    <script>
        function generatePDF() {
            // Choose the element that our invoice is rendered in.
            const element = document.getElementById("dvContainer");

            var opt = {
                margin: 0,
                filename: 'mina-carte.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            // Choose the element and save the PDF for our user.
            html2pdf().set(opt).from(element).save();
            // html2pdf().set(opt).from(element).output('blob');
        }
    </script>

</head>

<body>

    <?php
    // include_once('header.php');
    ?>
    <div class="header-content no-header">

        <?php
        echo '<div class="title">Card generated</div>';
        ?>
    </div>

    <div class="container mt-5">

        <span class="title-page-list">
            <?php
            if (isset($_GET["toPrint"])) {
                if ((array) $_GET["toPrint"]) {

                    $id = $_GET["toPrint"];

                    if ($id != 0) {
                        $usersStr = implode(',', $id);

                        $query = "SELECT * FROM personne, program, groupe WHERE program.id_program = groupe.id_program AND
                            personne.id_group = groupe.id_group AND personne.id_program = program.id_program AND id_person IN ($usersStr) LIMIT 1";
                        $result = $conn->query($query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="card.php?group-details=' . $row["id_group"] . '" class="nav-link">
                                <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back
                            </a>';
                            }
                            echo '<hr class="hr">
                            </span>
                            <div class="top"></div>
                    
                            <button type="submit" id="download" class="btn btn-outline-primary" onclick="generatePDF()">Download card</button>
                        </div>';
                        }
                    } elseif ($id == 0) {
                        echo '<a href="index.php" class="nav-link">
                        <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back to the home page
                    </a> <br> <br>';

                        echo '<div class="hint">You haven\'t send any data to the server, you will redirected to the home page</div>';
                    }
                }
            } else {
                echo '<a href="index.php" class="nav-link">
                    <i class="bi bi-arrow-left-short"></i> <span class="align-items"></span>Back to the home page
                </a> <br> <br>';

                echo '<div class="hint">You haven\'t send any data to the server, you will redirected to the home page</div>';
            }
            ?>
        </span>

        <div id="dvContainer" class="grid m-5">
            <ul>
                <?php

                // foreach ((array) $_GET["toPrint"] ?? [] as $selectedPerson) {

                // $id = $selectedPerson;
                if (isset($_GET["toPrint"])) {
                    if ((array) $_GET["toPrint"]) {

                        $id = $_GET["toPrint"];

                        if ($id != 0) {

                            $usersStr = implode(',', $id);
                            $query = "SELECT * FROM personne, program, groupe WHERE program.id_program = groupe.id_program AND
                                        personne.id_group = groupe.id_group AND personne.id_program = program.id_program AND id_person IN ($usersStr)";
                            $result = $conn->query($query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li>
                                    <div class="card">
                                        <div class="header">
                                            <ul>
                                                <li class="float-start">' . $row["program_name"] . '</li>
                                                <li class="float-end">
                                                    <img src="../Assets/images/' . $row["image"] . '" alt="program" class="img-program">
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <div class="width-card">
                                            <ul>
                                                <li class="for-img">
                                                    <img src="../Assets/profile/';
                                    if (empty($row["profile_image"])) {
                                        $profile = "profile.png";
                                        echo $profile;
                                    } else {
                                        $profile =  $row["profile_image"];
                                        echo $profile;
                                    }
                                    echo '" alt="person" class="img-content">
                                                </li>
                                            
                                                <li class="for-infos">
                                                    <div class="more-infos">
                                                        <ul>
                                                            <li><span class="card_number"><b> ID : </b>' . $row["card_number"] . '</span></li>
                                                            <li><a> <b> Groupe : </b>' . $row["nom_groupe"] . '</a></li>
                                                            <li><a> <b> Nom : </b>' . $row["nom"] . ' ' . $row["prenom"] . '</a></li>
                                                            <li><a> <b> Date de naissance : </b>' . $row["date_naissance"] . '</a></li>
                                                            <li><a> <b> Lieu de naissance : </b>' . $row["lieu_naissance"] . '</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom">
                                            <hr>
                                            CARD GENERATE BY MINA
                                            <p> </p>
                                        </div>
                                    </div>


                                </li>';
                                }
                            }
                        }
                    }
                } else {
                    echo '<div class="hint"> <div class="top"></div> Sorry ! No person was selected</div>';
                }

                ?>
            </ul>
        </div>

        <div class="mb-5">
            <br><br>
        </div>
    </div>

    <?php
    include_once('footer.php');
    ?>
</body>

</html>

<!-- 
<script type="text/javascript">
   
</script> -->