<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); 
    exit;
};
?>


<?php
require 'partials/db_connect.php'; // Ensure you are connected to the database

// Get the thread ID from the URL
$id = $_GET['threadid'];

// Fetch thread details
$sql = "SELECT * FROM `threads` WHERE `thread_id` = '$id'";
$result = mysqli_query($conn, $sql);
$threadtitle = '';
$threaddesc = '';
while ($row = mysqli_fetch_assoc($result)) {
    $threadtitle = $row['thread_title'];
    $threaddesc = $row['thread_desc'];
}

// Handle comment submission
$alertMessage = ''; // Variable to store the alert message
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_desc = isset($_POST['comment']) ? mysqli_real_escape_string($conn, $_POST['comment']) : '';

    // Check if the comment field is not empty
    if (!empty($comment_desc)) {
        // Insert comment into the database
        $sql = "INSERT INTO `comment` (`comment_desc`, `thread_id`, `comment_time`) 
                VALUES ('$comment_desc', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Success message
            $alertMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Your comment has been posted successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
        } else {
            // Error message
            $alertMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> There was an issue posting your comment. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
        }
    } else {
        // Validation error message
        $alertMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Warning!</strong> Please type a comment before posting.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShareIdeas - Codings Ideas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/nav.php'; ?>

    <!-- Dismissable Alert (Appears after Navbar) -->
    <?php if ($alertMessage != ''): ?>
    <div id="alertContainer">
        <?php echo $alertMessage; ?>
    </div>
    <?php endif; ?>

    <div class="container my-4">
        <div class="h-100 p-5 bg-primary-subtle border border-primary rounded-3 shadow-lg text-dark">
            <h2 class="mb-3"><?php echo $threadtitle; ?></h2>
            <p><?php echo $threaddesc; ?></p>

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
        </div>
    </div>

    <div class="container">
        <h2>Comment on the discussion below</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>

    <div class="container my-2">
        <h2>Discussion Comments</h2>
        <?php
        // Fetch and display the comments for this thread
        $sql = "SELECT * FROM `comment` WHERE `thread_id` = '$id' ORDER BY `comment_time` DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $comment_desc = $row['comment_desc'];
            $comment_time = $row['comment_time'];

            echo '<div class="card my-2">
                    <div class="card-body">
                        <p class="card-text">' . $comment_desc . '</p>
                        <footer class="blockquote-footer text-muted">Posted on ' . date("F j, Y, g:i a", strtotime($comment_time)) . '</footer>
                    </div>
                </div>';
        }
        ?>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Custom JS for auto-dismiss alert after a few seconds -->
    <script>
    // Dismiss the alert automatically after 5 seconds
    window.onload = function() {
        setTimeout(function() {
            let alertElement = document.querySelector('.alert-dismissible');
            if (alertElement) {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    };
    </script>
</body>

</html>