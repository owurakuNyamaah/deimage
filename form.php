<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Contact</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = 'stylesheet' href = 'stylesheet.css' type = 'text/css'>
    </head>
    <body>
        <header>
            <div class = 'header'>
                <img src = 'images/logo.jpg' alt = 'logo'>
                <h1>De-Image Print Colors</h1>
                <a href = 'index.html' target = '_self'>Home <b>||</b></a>
                <a href = 'gallery.html' target = '_self'>Gallery <b>||</b></a>
                <a href = 'form.php' target = '_self'>Contact</a>
            </div>
        </header>

        <?php
            $name = $email = $message = $nameErr = $emailErr = $messageErr = '';
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (empty($_POST['name'])) {
                    $nameErr = 'enter you name';
                }else {
                    $name = test_input($_POST['name']);
                    if (!preg_match('/^[a-zA-Z]*$/', $name)) {
                        $nameErr = 'name must contain only alphabets and white spaces';
                    }
                }

                if (empty($_POST['email'])) {
                    $emailErr = 'enter your email address';
                }else {
                    $email = test_input($_POST['email']);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = 'invalid email';
                    }
                }

                if (empty($_POST['message'])) {
                    $messageErr = '';
                }else {
                    $message = test_input($_POST['message']);
                }
            }
        
        ?>

        <div class = 'form'>
            <h1><em>Contact<br>___</em></h1>
            <p>
                Please <em><b>call <big>0201588766 / 0249656700</big></b></em> or fill out the form below and we will get back to you:) 
                We love meeting new people.
            </p>

            <form method = 'post' action = 'form.php'>
                <label>NAME</label><span class = 'error'>  *<?php echo $nameErr; ?></span><br><br>
                <input type = 'text' name = 'name' value = '<?php echo $name; ?>'><br><br>
                <label>EMAIL</label><span class = 'error'>  *<?php echo $emailErr; ?></span><br><br>
                <input type = 'text' name = 'email' value = '<?php echo $email; ?>'><br><br>
                <label>MESSAGE</label><br><br>
                <textarea name = 'message' cols = '40' rows = '8'><?php echo $message; ?></textarea><br><br>
                <input type = 'submit' name = 'submit' value = 'SUBMIT'>
            </form>
        </div>

        <?php 
            if(isset($_POST['submit'])) {
                $to = 'www.deimageprint@live.com';
                $subject = 'Message from website';
                $message = $_POST['message'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $header = "From: owura with email: owurakun@gmail.com "."\r\n" .
                        " MIME-Version: 1.0" . "\r\n" .
                        "Content-Type: text/html; charset=utf-8";

                $emptyName = empty($_POST['name']);
                $emptyEmail = empty($_POST['email']);
                $emptyMessage = empty($_POST['message']);

                if($emptyName||$emptyEmail) {
                    echo "<p style='color:red;text-align:center;'>fill out the required fields*</p>";
                }elseif ($emptyMessage) {
                    echo "<p style=color:red;text-align:center;'>please write you message</p>";
                }else {
                    $sent = mail($to, $subject, $message, $header);
                    if($sent) {
                        echo "<p style='color:green;text-align:center;'>message sent. Thank you!</p>";
                    }else {
                        echo "<p style = 'color:green;text-align:center;'>Sorry message could not be sent</p>";
                    }
                }
            }

           ?>
        
    </body>
</html>