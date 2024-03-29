<?php
@include('connect.php');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $pass= md5(htmlspecialchars($_POST['password']));
            $cpass = md5(htmlspecialchars($_POST['cpassword']));
            $user_type = htmlspecialchars($_POST['user_type']);
            $select = " SELECT * FROM `user_form1` WHERE `email` = '$email' && `password` = '$pass' ";
            $stmt = $conn->prepare($select);
            $stmt->execute();
            $result = $stmt->fetchAll();
            if(count($result) > 0){
                $error[] = 'user already exist!';
            }
            else{
                if($pass != $cpass){
                    $error[] = 'password not matched!';
                }
                else{
                    $insert = "INSERT INTO `user_form1`(`name`, `email`, `password`, `user_type`) VALUES ('$name', '$email', '$pass', '$user_type')";
                    $stmt = $conn->prepare($insert);
                    $stmt->execute();
                    header('location:login_form.php');
                }
            }
        }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="text" name="name" required placeholder="enter your name">
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="password" name="cpassword" required placeholder="confirm your password">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login_form.php">login now</a></p>
        </form>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>