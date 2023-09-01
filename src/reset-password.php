<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$otp_sent = isset($_SESSION['otp'])
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!--stylesheet-->
    <link href="../css/login.css" rel="stylesheet">

    <!--icon css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reset Password</title>
</head>

<body>
    <div class="container-fluid">
        <form action="handle-otp.php" method="POST">
            <h4 class="text-center">Reset Password</h4>
            <div class="form-group mb-3 mt-5">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" <?php echo $otp_sent ? 'disabled value="'.$_SESSION['uname'].'"':'';?> required>
            </div>
            <?php
            if ($otp_sent){
                echo '<div class="form-group mb-3">
                        <label for="otp">One Time Passcode</label>
                        <input type="number" name="otp" class="form-control" id="otp" required>
                      </div>';
            }
            ?>
            <button type="submit" class="btn btn-primary mt-4"><?php echo $otp_sent ? 'Reset':'Send OTP'?></button>
            <a href="loginForm.php" style="display: block;text-align: center;padding-top: 25px;font-weight: bold;color: #146C94;text-decoration: none">Back to Login</a>
        </form>
    </div>

    <?php
    if (isset($_GET["msg"])) {
        $email = $_SESSION['email'];
        echo "<p style='color:#fff;text-align:center;'>".$_GET['msg']." <b>".$email."</b></p>";
    }
    ?>

    <script src="../js/login.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>