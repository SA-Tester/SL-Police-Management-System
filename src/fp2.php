<?php
session_start();
$reset_code = $_SESSION['reset_code'];

$message = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["resetcode"])) {
        if (empty($_POST["resetcode"])) {
            $message = "<h6 class='text-danger'>Please provide your reset code to proceed.</h6>";
        } else {
            $input_resetCode = trim($_POST["resetcode"]);
            if ($input_resetCode === $reset_code) {
                header("Location: fp3.php");
            } else {
                $message = "<h6 class='text-danger'>Invalid reset code. Please try again.</h6>";
            }
        }
    } else {
        $message = "<h6 class='text-danger'>Required values were not submitted.</h6>";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!--stylesheet-->
    <link href="../css/login.css" rel="stylesheet">

    <!--icon css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: #101D6B;
        }

        form {
            width: 30%;
            background-color: white;
            padding: 50px;
            border-radius: 20px;
            margin: 0 auto;
            margin-top: 75px;
            margin-bottom: 40px;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: #101D6B;
        }

        .btn-primary:hover {
            color: #101D6B;
            background: white;
            border: 1px solid #101D6B;
        }

        .form-control {
            color: rgba(0, 0, 0, 0.87);
            border-bottom-color: rgba(0, 0, 0, 0.42);
            box-shadow: none !important;
            border: none;
            border-bottom: 1px solid;
            border-radius: 4px 4px 0 0;
        }

        h4 {
            font-size: 2rem !important;
            font-weight: 700;
        }

        @media only screen and (max-width:750px) {
            form {
                width: 90% !important;
            }
        }
    </style>
    <title>Forgot Password</title>
</head>

<body>

    <div class="container-fluid">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h4 class="text-center">Forgot your password?</h4>
            <?= $message ?>
            <div class="form-group mb-3 mt-5">
                <label for="username">Enter the code</label>
                <input type="text" name="resetcode" class="form-control" id="resetcode" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Next</button>
        </form>
    </div>



    <script src="../js/login.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>