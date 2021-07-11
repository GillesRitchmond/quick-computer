<?php
include_once('Model/Connection.php');

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if (isset($_SESSION["statut"]) === 1) {
        header("location: View/index.php");
        exit;
    }
    else
    header("location: index.php");
}


if (isset($_POST["submit"])) {
    // session_start();

    // Define variables and initialize with empty values
    $user = $password = "";
    $user_err = $password_err = $login_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user = $_POST["code_user"];
        $password = $_POST["password"];
        $default_password = $_POST["password"];

        // Check if username is empty
        if (empty(trim($_POST["code_user"]))) {
            $user_err = "Veuillez insérer un code utilisateur valide.";
        } else {
            $user = trim($_POST["code_user"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Veuillez insérer un mot de passe valide.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($user_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT code_entreprise, code_user, nom, prenom, id_role, id_statut, password FROM users WHERE email = ?";


            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_user);

                // Set parameters
                $param_user = $user;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Store result
                    $stmt->store_result();

                    // Check if username exists, if yes then verify password
                    if ($stmt->num_rows == 1) {
                        // Bind result variables
                        $stmt->bind_result($code_entreprise, $code_user, $nom, $prenom, $id_role, $id_statut, $hashed_password);
                        if ($stmt->fetch()) {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                // session_start();

                                // Store data in session variables

                                $_SESSION["loggedin"] = true;
                                $_SESSION["code_entreprise"] = $code_entreprise;
                                $_SESSION["code_user"] = $code_user;
                                $_SESSION["nom"] = $nom;
                                $_SESSION["prenom"] = $prenom;
                                $_SESSION["role"] = $id_role;
                                $_SESSION["statut"] = $id_statut;
                                

                                // Redirect user to welcome page
                                if (isset($_SESSION["statut"]) && $_SESSION["statut"] === 1) 
                                {
                                    header("location:  View/index.php"); 
                                }



                                // header("location: View/dashboard.php");
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Email ou mot de passe est incorrect.";
                            }
                        }
                    } else {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Email ou mot de passe est incorrect.";
                    }
                } else {
                    echo "Oops! Quelques choses ne marche pas. Essayez de vous connecter plus tard.";
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $conn->close();
    }
}
?>

<!Doctype html>
<html>

<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>Login</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="View/css/style.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- BOOTSTRAP CSS & JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body class="login-page">
    <div class="container login-container">
        <div class="login-card">
            <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
            <form method="POST">
                <div class="box">
                    <div class="form-row">
                        <div class="form-card">
                            <h3>Connectez-vous</h3>
                            <hr>
                            <p><i>Veuillez insérez votre email et votre mot de passe</i></p>
                            <div class="mb-4 form-floating">
                                <input type="text" class="form-control" name="code_user" required>
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="mb-4 form-floating">
                                <input type="password" class="form-control" name="password" required>
                                <label for="floatingInput">Mot de passe</label>
                            </div>
                            <div class="col">
                                <button class="col-12 btn btn-primary" name="submit" type="submit">Se connecter</button>
                            </div>

                            <div class="col link mt-2">
                                <div class="col">
                                    <a href="#" class="text-muted nav-link">Mot de passe oublier ?</a>
                                </div>
                                <div class="col">
                                    <a href="#" class="nav-link">Terms of use. Privacy policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>