<?php
include_once('../Model/connection.php');
// session_start();

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
    <!-- <title>Home</title> -->

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/main.css"> -->

    <!-- BOOTSTRAP CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>
    <nav class="navbar">
        <div class="navbar-items" id="list">
            <ul>
                <li class="linked"><a class="navbar-brand">Mina</a></li>
                <li class="linked bullet-menu" >
                    <a href="" onclick="show_toggle(); return false" class="header-icon">
                        <i class="text-secondary bi bi-list"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-items" id="close">
            <ul>
                <li class="linked"><a class="navbar-brand">Mina</a></li>
                <li class="linked bullet-menu"  >
                    <a href="" onclick="close_toggle(); return false" class="header-icon">
                        <i class="text-secondary bi bi-x"></i>
                    </a>
                </li>
            </ul>
            <div id="mylinks">
                <ul>
                    <li><a href="">Users</a></li>
                    <li><a href="../Controller/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>

<script>
    /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */

    hide(document.getElementById('mylinks'));
    hide(document.getElementById('close'));

    function show_toggle() {
        show(document.getElementById('mylinks'));
        show(document.getElementById('close'));
        hide(document.getElementById('list'));

        var x = document.getElementById('list');

        if (x.style.display === "block") {
            x.style.display = "none";
        }
        //  else {
        //     x.style.display = "block";
        // }
    }

    function close_toggle() {
        var x = document.getElementById('close');

        // if (x.style.display === "contents") {
        //     x.style.display = "none";
        // } else {
        //     x.style.display = "block";
        // }

        show(document.getElementById('list'));
        hide(document.getElementById('mylinks'));
        hide(document.getElementById('close'));
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