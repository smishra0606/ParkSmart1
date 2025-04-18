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
$token = '';
$valid_token = false;

// Check if token is provided
if (isset($_GET['token'])) {
    $token = sanitizeInput($_GET['token']);
    
    // Verify token validity
    $sql = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $valid_token = true;
        $reset_data = $result->fetch_assoc();
    } else {
        $error = "Invalid or expired password reset link. Please request a new one.";
    }
}

// Process password reset form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $valid_token) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($password) || empty($confirm_password)) {
        $error = "Both password fields are required";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } else {
        // Update the user's password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $update_sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ss", $hashed_password, $reset_data['email']);
        
        if ($stmt->execute()) {
            // Delete the used token
            $delete_sql = "DELETE FROM password_resets WHERE token = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            
            $success = "Your password has been successfully reset. You can now log in with your new password.";
            
            // Get user ID for activity logging
            $user_sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $conn->prepare($user_sql);
            $stmt->bind_param("s", $reset_data['email']);
            $stmt->execute();
            $user_result = $stmt->get_result();
            
            if ($user_result->num_rows === 1) {
                $user = $user_result->fetch_assoc();
                logActivity($conn, $user['id'], 'password_reset', "Password reset completed for user ID: {$user['id']}");
            }
        } else {
            $error = "An error occurred while resetting your password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - ParkSmart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="auth-section">
        <div class="container">
            <div class="auth-container reset-password-container">
                <div class="auth-form-container">
                    <h1>Reset Your Password</h1>
                    <p>Create a new password for your account</p>
                    
                    <?php if($error): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($success): ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                        <div class="text-center">
                            <a href="pages/login.php" class="btn btn-primary">Go to Login</a>
                        </div>
                    <?php elseif($valid_token): ?>
                        <form action="?token=<?php echo $token; ?>" method="POST" class="auth-form" id="reset-form">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="password" name="password" required minlength="6">
                                </div>
                                <div class="password-requirements">
                                    Password must be at least 6 characters long
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <a href="forgot_password.php" class="btn btn-primary">Request New Reset Link</a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="auth-footer">
                        <p>Remember your password? <a href="pages/login.php">Log In</a></p>
                    </div>
                </div>
                
                <div class="auth-image">
                    <div class="auth-image-content">
                        <h2>Create a Strong Password</h2>
                        <p>Keep your account secure with a strong password.</p>
                        <div class="password-tips">
                            <h3>Password Tips:</h3>
                            <ul class="auth-features">
                                <li><i class="fas fa-check-circle"></i> Use at least 8 characters</li>
                                <li><i class="fas fa-check-circle"></i> Include uppercase and lowercase letters</li>
                                <li><i class="fas fa-check-circle"></i> Add numbers and special characters</li>
                                <li><i class="fas fa-check-circle"></i> Avoid using personal information</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
    <script>
        // Password validation
        const resetForm = document.getElementById('reset-form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        if (resetForm) {
            resetForm.addEventListener('submit', function(event) {
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert('Passwords do not match');
                }
            });
        }
    </script>
</body>
</html>
