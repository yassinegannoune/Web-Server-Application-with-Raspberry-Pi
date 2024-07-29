<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-image: url("img.png"); 
            background-size: contain;
            background-position: center;
            background-repeat: repeat;
            height: 50vh;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background-color: #ffffff;
            border: 1px solid #000000;
            border-radius: 5px;
            padding: 20px;
            max-width: 300px;
            text-align: center;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .login-form input[type="submit"] {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            width: 100%;
        }
    </style>
    <script type="text/javascript">
        function validateForm() {

            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;


            if (username === "" || password === "") {
                alert("Please enter both username and password");
                return false;
            }

            
            if (username === "admin" && password === "admin") {
                window.location.href = "p.php";
                return false;
            } else {
                alert("Invalid username or password");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <form class="login-form" name="loginForm" onsubmit="return validateForm();" method="post" style="padding-right: 50px;padding-left: 30px;">
            <h1>Login Page</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
