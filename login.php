<?php
session_start();

// // Check if the user is already logged in
// if (isset($_SESSION['user_id'])) {
//     header("Location: index.php"); // Change this to your admin or user dashboard page
//     exit();
// }

include('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute an SQL statement to retrieve user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        if ($email === "admin@gmail.com") { // Check if the user is an admin
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location:adminLogin.php"); //  admin dashboard page
            exit();
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location:index.php"); //user dashboard page
            exit();
        }
    } else {
        // Invalid login
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In </title>

    <link rel="stylesheet" href="assets/signup.css">
    <!-- Favicons -->
    <link href="assets/img/farm_1.png" rel="icon">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />

</head>

<body>
    <main>

        <section class="vh-100 bg-image" style="background-image: url('/assets/img/vr_1.jpg');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                    <form action="login.php" method="post">



                                        <div class="form-outline mb-4">
                                            <input type="email" class="form-control form-control-lg" id="email" name="email" required />
                                            <label class="form-label" for="form3Example3cg">Your Email</label>
                                        </div>



                                        <div class="form-outline mb-4">
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" required />
                                            <label class="form-label" for="form3Example4cg">Password</label>
                                        </div>



                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">LogIn</button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Don't Have an account? <a href="signup.php" class="fw-bold text-body"><u>SignUp Now!!</u></a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

</body>

</html>