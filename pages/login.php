<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mentoring Platform</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Page</title>

</head>

<body>

    <?php include('../components/header.html'); ?>


    <main>
        <div class="login-container">
            <h2>LOGIN</h2>
            <input type="text" class="login-input" placeholder="Username">
            <input type="password" class="login-input" placeholder="Password">
            <button class="login-button">Log in</button>
            <div class="login-footer">
                <a href="#" class="forgot-link">Forgotten your username or password?</a>
                <p><a href="#" class="register-link">New? Register HERE</a></p>
            </div>
        </div>
    </main>


    <footer>
        <!-- Footer content here -->

        <?php include('../components/footer.html'); ?>
    </footer>

</body>

</html>