<?php 
// Check if the user is logged in 
$loggedin = false; 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {     
    $loggedin = true; 
} else {     
    $loggedin = false; 
}  

echo '<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">     
    <div class="container-fluid">         
        <a href="' . ($loggedin ? 'welcome.php' : 'login.php') . '" class="navbar-brand">             
            <img src="logo.png" style="border-radius: 100px;" height="30px" width="35px">         
        </a>         
        <a class="navbar-brand" href="' . ($loggedin ? 'welcome.php' : 'login.php') . '">𝕤𝕙𝕒𝕣𝕖𝕚𝕕𝕖𝕒𝕤</a>         
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"             
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">             
            <span class="navbar-toggler-icon"></span>         
        </button>          
        <div class="collapse navbar-collapse" id="navbarSupportedContent">             
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">                 
                <li class="nav-item">                     
                    <a class="nav-link active" aria-current="page" href="' . ($loggedin ? 'welcome.php' : 'login.php') . '">Home</a>                 
                </li>                 
                <li class="nav-item">                     
                    <a class="nav-link active" aria-current="page" href="' . ($loggedin ? 'about.php' : 'aboutus.php') . '">About</a>                 
                </li>                 
                <li class="nav-item">                     
                    <a class="nav-link active" aria-current="page" href="' . ($loggedin ? 'contact.php' : 'contactus.php') . '">Contact Us</a>                 
                </li>             
            </ul>';  

echo '<div class="ms-auto d-flex">';  

if ($loggedin) {     
    // If the user is logged in, show the Logout button with modal trigger
    echo '<button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Logout</button>
    
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout? 
                    <p class="text-muted small mt-2">Your current session will be terminated.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="/login_system/logout.php" class="btn btn-danger">Yes, Logout</a>
                </div>
            </div>
        </div>
    </div>';
} else {     
    // If the user is not logged in, show the Login and SignUp buttons     
    echo '<a class="nav-link" href="/login_system/login.php">
            <button class="btn btn-primary me-2" type="button">Login</button>
          </a>
          <a class="nav-link" href="/login_system/signup.php">
            <button class="btn btn-primary" type="button">SignUp</button>
          </a>'; 
}  

echo '</div>';  

if ($loggedin) {     
    echo '<form class="d-flex ms-2" role="search">     
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">     
            <button class="btn btn-success" type="button">Search</button> 
          </form>'; 
}  

echo '</div> </div> </nav>'; 
?>