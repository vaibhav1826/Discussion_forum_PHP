<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShareIdeas - Contact Administrator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
        font-family: 'Roboto', sans-serif;
    }

    @keyframes gradientBG {
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

    .container {
        max-width: 800px;
        margin-top: 2rem;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        color: white;
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h2 {
        color: white;
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.5rem;
        animation: fadeInDown 1s ease forwards;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: white;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(45deg, #1a2a6c, #b21f1f);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(45deg, #b21f1f, #1a2a6c);
    }

    .alert {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: 90%;
        max-width: 600px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 10px;
        animation: slideDown 0.5s ease forwards;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translate(-50%, -20px);
        }

        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    .lead {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
    }

    .form-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
            margin: 1rem;
        }

        h2 {
            font-size: 1.75rem;
        }
    }
    </style>
</head>

<body>
    <?php require 'partials/nav.php'; ?>
    <?php include 'partials/db_connect.php'; ?>

    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $contact_name=$_POST['name'];
        $contact_email=$_POST['email'];
        $contact_message=$_POST['message'];
        $sql="INSERT INTO `contactus` (`contact_name`, `contact_email`, `contact_message`) VALUES ('$contact_name', '$contact_email', '$contact_message');";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thank you for contacting us!</strong> Your query will be solved shortly. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        else{
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> There was an issue sending your message. Please try again later.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    }
    ?>

    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Contact the Administrator</h2>
            <p class="lead text-center">If you have any inquiries, please use the form below to contact us.</p>

            <form action="contact.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>