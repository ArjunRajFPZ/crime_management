<?php include 'config.php' ?>

<?php
session_start();
$user_firstname = '';
$user_lastname = '';
$user_email = '';
$user_address = '';
$pincode = '';
$phone_no = '';
$gender = '';
$user_name = '';
$user_password = '';
$confirm_password = '';



if(isset($_POST['submit'])){

$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_email = $_POST['user_email'];
$user_address = $_POST['user_address'];
$pincode = $_POST['pincode'];
$phone_no = $_POST['phone_no'];
$gender = $_POST['gender'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$confirm_password = $_POST['confirm_password'];

if(isset($_POST['user_firstname']) && !empty($_POST['user_firstname']) && 
   isset($_POST['user_lastname']) && !empty($_POST['user_lastname']) &&
   isset($_POST['user_email']) && !empty($_POST['user_email']) &&
   isset($_POST['user_address']) && !empty($_POST['user_address']) &&
   isset($_POST['pincode']) && !empty($_POST['pincode']) &&
   isset($_POST['phone_no']) && !empty($_POST['phone_no']) &&
   isset($_POST['gender']) && !empty($_POST['gender']) &&
   isset($_POST['user_name']) && !empty($_POST['user_name']) &&
   isset($_POST['user_password']) && !empty($_POST['user_password']) &&
   isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])){




    if($_POST['user_password'] == $_POST['confirm_password']){
        //INSERT DATA
        $sql = "INSERT INTO user_registration (user_firstname,user_lastname,user_name,user_password,user_address,user_email,pincode,phone_no,gender,user_photo,user_type,status)
        VALUES ('$user_firstname','$user_lastname','$user_name','$user_password','$user_address','$user_email','$pincode','$phone_no','$gender','','user','active')";

        if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['success_message'] = "Form Successfully Submitted";
        header("Location: login.php");
        exit;
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }else{
         $_SESSION['form_error_message'] = "password mismatch";
    }
    

}else{
    $_SESSION['error_message'] = "All Fields are required";

}

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Register</b></a>
        </div>
        <div class="card">
            <div class="body">
                 <?php
                        if(isset($_SESSION['form_error_message']) && !empty($_SESSION['form_error_message'])){
                            ?>
                    <!-- Alerts -->
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $_SESSION['form_error_message']; ?>
                        </div>  
                        <?php
                        unset($_SESSION['form_error_message']);
                        }

                        ?>
                         <?php
                        if(isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])){
                            ?>
                    <!-- Alerts -->
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $_SESSION['error_message']; ?>
                        </div>  
                        <?php
                        unset($_SESSION['error_message']);
                        }

                        ?>
                <form action="" method="POST" >
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>" placeholder="First Name" required autofocus>
                        </div>
                    </div>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_lastname" placeholder="Last Name" value="<?php echo $user_lastname; ?>"  required >
                        </div>
                    </div>
                     
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">send</i>
                        </span>
                        <div class="form-line">
                                <?php if($user_address == ''): ?>
                                 <textarea class="form-control" name="user_address" placeholder="Address"></textarea>
                                <?php else : ?>
                                <textarea class="form-control" name="user_address" placeholder="Address"> <?php echo $user_address; ?></textarea>
                                <?php endif; ?>
                           
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">send</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="pincode"  value="<?php echo $pincode; ?>" placeholder="Pincode" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="phone_no" value="<?php echo $phone_no; ?>" placeholder="Phone number" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                         <select class="form-control"  id="sel1" name="gender">
                               <option value="" >Select Gender</option>
                           <option value="male" <?php if ($gender == 'male') echo ' selected="selected"'; ?>>Male</option>
                            <option value="female" <?php if ($gender == 'female') echo ' selected="selected"'; ?>>Female</option>
                             <option value="transgender" <?php if ($gender == 'transgender') echo ' selected="selected"'; ?>>Transgender</option>
                            
                          </select>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" value="<?php echo $user_name; ?>" name="user_name" placeholder="User Name" required >
                        </div>
                    </div>



                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password" placeholder="Password" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" value="<?php echo $confirm_password; ?>" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                   
                       
                    <button class="btn btn-block btn-lg bg-pink waves-effect" name="submit" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="login.php">Already a member?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-up.js"></script>
</body>

</html>