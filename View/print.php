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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

</head>

<body>

    <div class="grid m-5">
        <ul>
            <?php

            // if (is_array($_GET["toPrint"]) || is_object($_GET["toPrint"])) {
                foreach((array) $_GET["toPrint"] ?? [] as $selectedPerson){
                    
                $id = $selectedPerson;
                $query = "SELECT * FROM personne, program, groupe WHERE program.id_program = groupe.id_program AND
                        personne.id_group = groupe.id_group AND personne.id_program = program.id_program AND id_person = '$id'";
                $result = $conn->query($query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li>
                                <div class="card">
                                    <div class="header">
                                        <ul>
                                            <li class="float-start">'.$row["program_name"].'</li>
                                            <li class="float-end">
                                                <img src="../Assets/images/'.$row["image"].'" alt="program" class="img-program" style="width:100%">
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="../Assets/profile/';
                                        if (empty($row["profile_image"])) {
                                            $profile = "profile.png";
                                            echo $profile;
                                        } else {
                                            $profile =  $row["profile_image"];
                                            echo $profile;
                                        }
                                    echo'" alt="person" class="img-content" style="width:100%">
                                    
                                    <div class="more-infos">
                                        <ul>
                                            <li><span class="card_number">ID : '.$row["card_number"].'</span></li>
                                            <li><a> Group : '.$row["nom_groupe"].'</a></li>
                                            <li><a>'.$row["nom"].' '.$row["prenom"].'</a></li>
                                            <li><a>'.$row["date_naissance"].'</a></li>
                                            <li><a>'.$row["lieu_naissance"].'</a></li>
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
            // }

            ?>
        </ul>
    </div>

</body>

</html>


<script type="text/javascript">
    
    // var doc = new jsPDF();

    // var elementHandler = {
    //     '#ignorePDF': function(element, renderer) {
    //         return true;
    //     }
    // };

    // var source = window.document.getElementsByTagName("body")[0];
    
    // doc.fromHTML(
    //     source,
    //     15,
    //     15, {
    //         'width': 180,
    //         'elementHandlers': elementHandler
    //     });

    // printDoc.autoPrint();
    // doc.output("dataurlnewwindow");


    // var elementHandler = {
    //     '#ignoreElement': function(element, renderer) {
    //         return true;
    //     },
    //     '#anotherIdToBeIgnored': function(element, renderer) {
    //         return true;
    //     }
    // };





    // <embed
    // type = "application/pdf"
    // src = "path_to_pdf_document.pdf"
    // id = "pdfDocument"
    // width = "100%"
    // height = "100%" />

    //     function printDocument(documentId) {
    //         var doc = document.getElementById(documentId);

    //         //Wait until PDF is ready to print    
    //         if (typeof doc.print === 'undefined') {
    //             setTimeout(function() {
    //                 printDocument(documentId);
    //             }, 1000);
    //         } else {
    //             doc.print();
    //         }
    //     }


    // window.print();
    // setTimeout(function() {
    //     window.close()
    // }, 750)
</script>