<!-- connection with database using include -->
<?php
    $showalert=false;
    $showerror=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'partials\db_connect.php';
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassword"];
        $sql="SELECT * FROM `users` where username='$username'";
        $result=mysqli_query($conn,$sql);
        $row_num=mysqli_num_rows($result);
        if($row_num>0){
          $showerror="username exists , try with another username";
        }
        else{
          if($password==$cpassword ){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users`( `username`, `email`, `password`) VALUES ('$username','$email','$hash')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showalert=true;
            }
        else{
            $showerror="Invalid credentials ";
        }
      }
        }
    }
 ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        min-height: 100vh;
        margin: 0;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Form styling */
    .container form {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        transform: translateY(0);
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .container form:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    /* Input field styling */
    .form-control {
        border: 2px solid #e1e1e1;
        border-radius: 10px;
        padding: 12px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        transform: translateY(-2px);
    }

    /* Label animation */
    .form-label {
        transition: all 0.3s ease;
        color: #666;
    }

    .form-control:focus+.form-label,
    .form-control:not(:placeholder-shown)+.form-label {
        color: #4a90e2;
        transform: translateY(-25px);
    }

    /* Button styling */
    .btn-primary {
        background: linear-gradient(45deg, #4a90e2, #63b3ed);
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
    }

    .btn-primary:active {
        transform: translateY(1px);
    }

    /* Title styling */
    h1 {
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-weight: 700;
        margin-bottom: 2rem;
        opacity: 0;
        animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Alert styling */
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        border-radius: 10px;
        animation: slideIn 0.5s ease-out;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Loading state */
    .btn-primary.loading {
        background: linear-gradient(45deg, #4a90e2, #63b3ed);
        background-size: 200% 200%;
        animation: gradientMove 1s ease infinite;
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Responsive design improvements */
    @media (max-width: 768px) {
        .container form {
            margin: 20px;
            padding: 20px !important;
        }

        h1 {
            font-size: 1.8rem;
        }
    }
    </style>
</head>

<body>
    <!-- including navbar -->
    <?php
    require 'partials\nav.php';
    if ($showalert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account has been successfully created.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    if ($showerror) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '.$showerror.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>


    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Sign up to our website</h1>
            <form action="/login_system/signup.php" method="POST" class="p-4 border rounded shadow bg-light">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <small class="text-danger" id="usernameError"></small>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <small class="text-danger" id="emailError"></small>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" id="submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>