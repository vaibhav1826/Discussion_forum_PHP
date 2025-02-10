<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShareIdeas - About Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
        font-family: 'Roboto', sans-serif;
        color: white;
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
        max-width: 1200px;
        margin-top: 6rem;
        padding: 2rem;
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.6s ease forwards;
    }

    .card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        color: white;
        padding: 2rem;
    }

    .section-title {
        color: #fdbb2d;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 3px;
        background: #fdbb2d;
        transition: width 0.3s ease;
    }

    .card:hover .section-title::after {
        width: 100%;
    }

    .feature-icon {
        font-size: 2.5rem;
        color: #fdbb2d;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .card:hover .feature-icon {
        transform: scale(1.2);
    }

    .btn-primary {
        background: linear-gradient(45deg, #1a2a6c, #b21f1f);
        border: none;
        border-radius: 8px;
        padding: 1rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(45deg, #b21f1f, #1a2a6c);
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .logo-container img {
        max-height: 60px;
        margin: 0 10px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .feature-list li {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .feature-list li i {
        margin-right: 10px;
        color: #fdbb2d;
    }

    hr.divider {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(253, 187, 45, 0.5), transparent);
        margin: 3rem 0;
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

    @media (max-width: 768px) {
        .container {
            margin-top: 4rem;
            padding: 1rem;
        }

        .glass-container {
            padding: 1rem;
        }

        .card {
            margin-bottom: 1.5rem;
        }
    }
    </style>
</head>

<body>
    <?php require 'partials/nav.php'; ?>

    <div class="container">
        <div class="glass-container">
            <div class="logo-container">
                <img src="logo.png" alt="Logo">
                <h2 class="section-title text-center">Welcome to ShareIdeas</h2>
            </div>

            <p class="lead text-center mb-5">Empowering developers to connect, collaborate, and create together.</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-rocket feature-icon"></i>
                            <h3 class="section-title">Our Mission</h3>
                            <p>ShareIdeas is a vibrant community where developers unite to solve problems, share
                                knowledge, and grow together. From beginners to experts, everyone has a voice in shaping
                                the future of coding.</p>
                            <p>We foster an environment of continuous learning and mutual support, making coding
                                education accessible and enjoyable for all.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-cogs feature-icon"></i>
                            <h3 class="section-title">How It Works</h3>
                            <ul class="feature-list list-unstyled">
                                <li><i class="fas fa-lightbulb"></i>Share your innovative ideas and challenges</li>
                                <li><i class="fas fa-users"></i>Get expert guidance from the community</li>
                                <li><i class="fas fa-graduation-cap"></i>Learn through practical problem-solving</li>
                                <li><i class="fas fa-network-wired"></i>Build lasting connections with peers</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="divider">

            <div class="text-center">
                <h3 class="section-title">Join Our Community</h3>
                <p class="mb-4">Be part of something bigger. Your knowledge and experience can make a difference.</p>
                <a href="<?php echo ($loggedin) ? 'welcome.php' : 'login.php'; ?>" class="btn btn-primary btn-lg">
                    Get Started <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on scroll
        const cards = document.querySelectorAll('.card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    });
    </script>
</body>

</html>