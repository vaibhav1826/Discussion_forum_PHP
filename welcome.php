<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); 
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShareIdeas- users-<?php echo $_SESSION['username']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
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

    /* Container Styling */
    .container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    /* Heading Style */
    h1 {
        color: white;
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 2rem;
        font-size: 2.5rem;
        opacity: 0;
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

    /* Card Styling */
    .card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(0);
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        transition: all 0.3s ease;
        object-fit: cover;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .card-title a {
        color: #1a2a6c;
        transition: all 0.3s ease;
    }

    .card-title a:hover {
        color: #b21f1f;
        text-decoration: none;
    }

    .card-text {
        color: #666;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    /* Button Styling */
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

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        h1 {
            font-size: 2rem;
        }

        .card {
            margin: 0 auto;
        }
    }

    /* Animation for Cards */
    .col-md-4 {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .col-md-4:nth-child(1) {
        animation-delay: 0.2s;
    }

    .col-md-4:nth-child(2) {
        animation-delay: 0.4s;
    }

    .col-md-4:nth-child(3) {
        animation-delay: 0.6s;
    }

    .col-md-4:nth-child(4) {
        animation-delay: 0.8s;
    }

    .col-md-4:nth-child(5) {
        animation-delay: 1.0s;
    }

    .col-md-4:nth-child(6) {
        animation-delay: 1.2s;
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

    /* Footer Enhancement */
    .footer {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        margin-top: 2rem;
        padding: 1rem 0;
        color: white;
    }
    </style>
</head>

<body>

    <?php
    require 'partials/nav.php'; ?>

    <?php require 'partials/db_connect.php'; ?>

    <div class="container my-3">
        <h1 class="text-center">𝖘𝖍𝖆𝖗𝖊 𝖞𝖔𝖚𝖗 𝖎𝖉𝖊𝖆𝖘 𝖔𝖓 𝖙𝖍𝖊𝖘𝖊 𝖈𝖆𝖙𝖊𝖌𝖔𝖗𝖎𝖊𝖘</h1>
        <div class="row">
            <?php 
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $des = $row['category_description'];
                echo '<div class="col-md-4 my-2">
                <div class="card my-2" style="width: 18rem;">
                    <img src="'.$row['category_name'].'.png" class="card-img-top" alt="..." height="175px" >
                    <div class="card-body ">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.'" style="text-decoration: none;">'.$row['category_name'].'</a></h5>
                        <p class="card-text">'.substr($des,0,75).'...</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">Explore thread</a>
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add hover effect to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });

            // Add click animation
            card.addEventListener('click', function(e) {
                if (!e.target.classList.contains('btn-primary')) {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);
                }
            });
        });

        // Lazy loading for images
        const images = document.querySelectorAll('img');
        const imageOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px 50px 0px'
        };

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.style.opacity = '1';
                    observer.unobserve(img);
                }
            });
        }, imageOptions);

        images.forEach(img => {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.5s ease-in';
            imageObserver.observe(img);
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>