<?php
ob_start();
?>

<?php include 'header.php' ?>
<?php

if(isset($_POST['submit'])){

$name_of_missing_person = $_POST['name_of_missing_person'];
$age_of_missing_person = $_POST['age_of_missing_person'];
$gender = $_POST['gender'];
$details = $_POST['details'];
$contact_no = $_POST['contact_no'];


if(isset($_POST['name_of_missing_person']) && !empty($_POST['name_of_missing_person']) &&
   isset($_POST['age_of_missing_person']) && !empty($_POST['age_of_missing_person']) &&
   isset($_POST['gender']) && !empty($_POST['gender']) &&
   isset($_POST['details']) && !empty($_POST['details']) &&
   isset($_POST['contact_no']) && !empty($_POST['contact_no']) ){


    if (empty($_FILES['missing_photo']['tmp_name']) && !file_exists($_FILES['missing_photo']['tmp_name'])) {
       $_SESSION['complaint_registration_error_message'] = "Please upload evidence";
    }else{ 
         $_SESSION['complaint_registration_success_message'] = "Form Successfully Submitted";


    $missing_photo_base64 = base64_encode(file_get_contents($_FILES['missing_photo']['tmp_name']) );
    $missing_photo = 'data:image/'.$imageFileType.';base64,'.$missing_photo_base64;

          //INSERT DATA
        $sql = "INSERT INTO complaint_registration (user_id,name_of_missing_person,age_of_missing_person,gender,details,last_spotted,contact_no,missing_photo,status)
        VALUES ('1','$name_of_missing_person','$age_of_missing_person','$gender','$details','$last_spotted','$contact_no','$missing_photo','active')";

        if ($connect->query($sql) === TRUE) {
            $_SESSION['missing_person_registration_success_message'] = "Form Successfully Submitted";
            header("Location:missing_add.php");
           //echo "<meta http-equiv='refresh' content='0'>";
            
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
  $connect->close();
}else{
    $_SESSION['missing_person_registration_error_message'] = "All Fields are required";
}

}

?>

<section class="content">
        <div class="container-fluid">
<!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Missing Add
                            </h2>
                        </div>
                        <div class="body">
                        <!-- Alerts -->
                             <?php
                        if(isset($_SESSION['missing_person_registration_error_message']) && !empty($_SESSION['missing_person_registration_message'])){
                            ?>
                    <!-- Alerts -->
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $_SESSION['missing_person_registration_error_message']; ?>
                        </div>  
                        <?php
                        unset($_SESSION['missing_person_registration_error_message']);
                        }

                        ?>
                         <?php
                        if(isset($_SESSION['missing_person_registration_success_message']) && !empty($_SESSION['missing_person_registration_success_message'])){
                            ?>
                    <!-- Alerts -->
                         <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo $_SESSION['missing_person_registration_message']; ?>
                            </div>
                        <?php
                        unset($_SESSION['missing_person_registration_success_message']);
                        }

                        ?>

                        <!-- Form -->
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <!-- Email start-->
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name_of_missing_person">Name of Missing Person</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name_of_missing_person" class="form-control" placeholder="Enter Name of Missing Person" name="name_of_missing_person">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="age_of_missing_person">Age of Missing Person</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" min="0" id="age_of_missing_person" class="form-control" placeholder="Enter Age of Missing Person" name="age_of_missing_person">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="radio">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                             <div class="demo-radio-button">
                                                <input name="gender" type="radio" id="male" value="male" />
                                                <label for="male">Male</label>
                                                <input name="gender" type="radio" id="female" value="female"/>
                                                <label for="female">Female</label>
                                                 <input name="gender" type="radio" id="transgender" value="transgender"  />
                                                <label for="transgender">Transgender</label>
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="details">Details</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" id="details" placeholder="Please type Missing Person details..." name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="last_spotted">Last spotted </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="last_spotted" class="form-control" placeholder="Last Spotted" name="last_spotted">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="contact_no">Contact Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" min="0" id="contact_no" class="form-control" placeholder="Enter contact number" name="contact_no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="missing_photo"> Missing Photo Upload</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <input type="file" class="form-control" name="missing_photo">
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- button start -->
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="submit">Submit</button>
                                    </div>
                                </div>
                                <!-- button end -->
                            </form>
                            <!-- form ENd -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->    </div>
</section>

 <?php include 'footer.php'?>
