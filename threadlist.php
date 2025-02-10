<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); 
    exit;
};
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShareIdeas - Codings Ideas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    /* Global Enhancements */
    body {
        background: linear-gradient(135deg, #f4f7f6, #e6e9e8);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Category Info Box Styling */
    .bg-primary-subtle {
        background: linear-gradient(135deg, #ffffff, #f0f3f2) !important;
        border: 2px solid #6c757d !important;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .bg-primary-subtle::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.05);
        transform: rotate(-45deg);
        z-index: 1;
    }

    .bg-primary-subtle:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }

    /* Forum Rules Styling */
    .list-unstyled li {
        padding: 10px 15px;
        margin-bottom: 5px;
        border-left: 4px solid #6c757d;
        background-color: rgba(108, 117, 125, 0.05);
        transition: all 0.3s ease;
    }

    .list-unstyled li:hover {
        background-color: rgba(108, 117, 125, 0.1);
        border-left-color: #007bff;
        transform: translateX(10px);
    }

    /* Form Elements */
    .form-control {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Thread List Styling */
    .media {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .media::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 5%;
        width: 90%;
        height: 5px;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 0 0 12px 12px;
        z-index: -1;
    }

    .media:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .media-body a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .media-body a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Button Styling */
    .btn-success,
    .btn-primary {
        border-radius: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-success:hover,
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .media {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    }

    /* Alert Styling */
    .alert {
        border-radius: 8px;
        padding: 15px;
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <?php 
    require 'partials/db_connect.php'; 
    require 'partials/nav.php'; 
    ?>

    <?php
    // Initialize the category ID from the query string
    $id = isset($_GET['catid']) ? intval($_GET['catid']) : 0;

    // Fetch category info only if $id is valid
    if ($id > 0) {
        $sql = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc = $row['category_description'];
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                    <strong>Error!</strong> The specified category was not found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
                <strong>Warning!</strong> Invalid category ID.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

    <!-- Alert for form submission status -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize input
        $th_title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
        $th_desc = isset($_POST['desc']) ? mysqli_real_escape_string($conn, $_POST['desc']) : '';

        // Check if the form fields are not empty
        if (!empty($th_title) && !empty($th_desc)) {
            // Insert the thread into the database
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
                    VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Success message
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                        <strong>Success!</strong> Your thread has been posted successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                // Error message
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                        <strong>Error!</strong> There was an issue posting your thread. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        } else {
            // Validation error message
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
                    <strong>Warning!</strong> Please fill in both the title and description.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="h-100 p-5 bg-primary-subtle border border-primary rounded-3 shadow-lg text-dark">
            <h2 class="mb-3"><?php echo isset($catname) ? $catname : 'Category Not Found'; ?></h2>
            <p><?php echo isset($catdesc) ? $catdesc : ''; ?></p>

            <div class="border border-primary opacity-75 my-4"></div>

            <h4 class="fw-bold">Forum Rules & Guidelines</h4>
            <p class="mb-3">To ensure a respectful and engaging discussion, please follow these guidelines:</p>

            <ul class="list-unstyled">
                <li>✅ **Be Respectful** – Treat all members with kindness and avoid offensive language.</li>
                <li>✅ **Stay On Topic** – Keep discussions relevant to the forum category.</li>
                <li>✅ **No Spam or Self-Promotion** – Avoid excessive self-promotion, advertisements, or irrelevant
                    links.</li>
                <li>✅ **Constructive Contributions** – Share meaningful insights and avoid unnecessary negativity.</li>
                <li>✅ **Privacy Matters** – Do not share personal information, and respect others' privacy.</li>
                <li>✅ **Follow the Law** – Do not post illegal content or violate copyrights.</li>
            </ul>

            <p class="mt-3">By participating in this forum, you agree to abide by these rules. Let’s build a positive
                and insightful community together! 🚀</p>

            <button class="btn btn-primary mt-3" type="button">Learn More</button>
        </div>
    </div>

    <div class="container">
        <h2>Start a discussion</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div id="titleHelp" class="form-text">Keep your problem title as short as possible.</div>
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description of the problem</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="container my-2">
        <h2>Browse Questions</h2>
    </div>

    <?php
    if ($id > 0) {
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
        $result = mysqli_query($conn, $sql);

        // Check if there are threads to display
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $threadtitle = $row['thread_title'];
                $threaddes = $row['thread_desc'];

                echo '<div class="container">
                        <div class="media my-3">
                        <img src="user.png" alt="..." height="45px" width="50px" class="mr-3 mb-1">
                            <div class="media-body">
                               <a href="thread.php?threadid=' . $row['thread_id'] . '"><h5>' . $threadtitle . '</h5></a>
                                <p>' . $threaddes . '</p> 
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<div class="container"><p class="text-muted">No threads found in this category. Be the first to ask a question!</p></div>';
        }
    }
    ?>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Custom JS for auto-dismiss alert after 2 seconds -->
    <script>
    // Dismiss the alert automatically after 2 seconds
    window.onload = function() {
        setTimeout(function() {
            let alertElement = document.querySelector('.alert-dismissible');
            if (alertElement) {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    };
    </script>
</body>

</html>