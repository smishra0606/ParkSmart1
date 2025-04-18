<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
session_start();

// If user is already logged in, redirect to dashboard
if (isLoggedIn()) {
    redirect('pages/dashboard.php');
}

$error = '';
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    
    if (empty($email)) {
        $error = "Email address is required";
    } else {
        // Check if email exists in the database
        $sql = "SELECT id, username FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Generate a token
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // Delete any existing token for this email
            $delete_sql = "DELETE FROM password_resets WHERE email = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            
            // Store the token in the database
            $insert_sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("sss", $email, $token, $expires_at);
            
            if ($stmt->execute()) {
                // Build the reset URL
                $reset_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . 
                            "://" . $_SERVER['HTTP_HOST'] . 
                            dirname($_SERVER['PHP_SELF']) . "/reset_password.php?token=" . $token;
                
                // In a real application, you would send an email here
                // For this demonstration, we'll just show the reset link
                $success = "Password reset link has been sent to your email address.";
                
                // Log the password reset request
                logActivity($conn, $user['id'], 'password_reset_request', "Password reset requested for user ID: {$user['id']}");
                
                // In a local/testing environment, you might want to display the link
                $reset_link = "<div class='reset-link-display'>
                                <p>Since this is a local development environment, here's the reset link:</p>
                                <a href='{$reset_url}' target='_blank'>{$reset_url}</a>
                               </div>";
            } else {
                $error = "An error occurred. Please try again.";
            }
        } else {
            // Don't reveal if the email exists or not (security best practice)
            $success = "If the email address exists in our system, a password reset link will be sent.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - ParkSmart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="auth-section">
        <div class="container">
            <div class="auth-container forgot-password-container">
                <div class="auth-form-container">
                    <h1>Forgot Your Password?</h1>
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                    
                    <?php if($error): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($success): ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                        
                        <?php if(isset($reset_link)): ?>
                            <?php echo $reset_link; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <form action="" method="POST" class="auth-form">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                    </form>
                    
                    <div class="auth-footer">
                        <p>Remember your password? <a href="pages/login.php">Log In</a></p>
                    </div>
                </div>
                
                <div class="auth-image">
                    <div class="auth-image-content">
                        <h2>Password Recovery</h2>
                        <p>We'll help you get back into your account safely.</p>
                        <ul class="auth-features">
                            <li><i class="fas fa-lock"></i> Secure password reset</li>
                            <li><i class="fas fa-envelope"></i> Email verification</li>
                            <li><i class="fas fa-shield-alt"></i> Account protection</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
</body>
</html>
