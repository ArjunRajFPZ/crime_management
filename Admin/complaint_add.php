<?php
ob_start();
?>

<?php include 'header.php' ?>
<?php

if(isset($_POST['submit'])){

$complaint_type = $_POST['complaint_type'];
$suspect_name = $_POST['suspect_name'];
$suspect_age = $_POST['suspect_age'];
$place_of_crime = $_POST['place_of_crime'];
$date_of_crime = $_POST['date_of_crime'];
$time_of_crime = $_POST['time_of_crime'];


if(isset($_POST['complaint_type']) && !empty($_POST['complaint_type']) &&
   isset($_POST['suspect_name']) && !empty($_POST['suspect_name']) &&
   isset($_POST['suspect_age']) && !empty($_POST['suspect_age']) &&
   isset($_POST['place_of_crime']) && !empty($_POST['place_of_crime']) &&
   isset($_POST['date_of_crime']) && !empty($_POST['date_of_crime']) &&
   isset($_POST['time_of_crime']) && !empty($_POST['time_of_crime']) ){


    if (empty($_FILES['evidence_photo']['tmp_name']) && !file_exists($_FILES['evidence_photo']['tmp_name'])) {
       $_SESSION['complaint_registration_error_message'] = "Please upload evidence";
    }else{ 
         $_SESSION['complaint_registration_success_message'] = "Form Successfully Submitted";


    $evidence_photo_base64 = base64_encode(file_get_contents($_FILES['evidence_photo']['tmp_name']) );
    $evidence_photo = 'data:image/'.$imageFileType.';base64,'.$evidence_photo_base64;

          //INSERT DATA
        $sql = "INSERT INTO complaint_registration (user_id,complaint_type,suspect_name,suspect_age,place_of_crime,date_of_crime,time_of_crime,evidence_photo,complaint_assigned_to,complaint_assigned_status,complaint_status)
        VALUES ('1','$complaint_type','$suspect_name','$suspect_age','$place_of_crime','$date_of_crime','$time_of_crime','$evidence_photo','$complaint_assigned_to','$complaint_assigned_status','active')";

        if ($connect->query($sql) === TRUE) {
            $_SESSION['complaint_registration_success_message'] = "Form Successfully Submitted";
            header("Location:complaint_add.php");
           //echo "<meta http-equiv='refresh' content='0'>";
            
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
  $connect->close();
}else{
    $_SESSION['complaint_registration_error_message'] = "All Fields are required";
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
                               Complaint Add
                            </h2>
                        </div>
                        <div class="body">
                     <!-- Alerts -->
                             <?php
                        if(isset($_SESSION['complaint_registration_error_message']) && !empty($_SESSION['complaint_error_message'])){
                            ?>
                    <!-- Alerts -->
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $_SESSION['complaint_registration_error_message']; ?>
                        </div>  
                        <?php
                        unset($_SESSION['complaint_registration_error_message']);
                        }

                        ?>
                         <?php
                        if(isset($_SESSION['complaint_registration_success_message']) && !empty($_SESSION['complaint_registration_success_message'])){
                            ?>
                    <!-- Alerts -->
                         <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo $_SESSION['complaint_success_message']; ?>
                            </div>
                        <?php
                        unset($_SESSION['complaint_registration_success_message']);
                        }

                        ?>


                        <!-- Form -->
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <!-- Email start-->
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="complaint_type">Complaint Type</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="complaint_type" class="form-control" placeholder="Enter Complaint type" name="complaint_type">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="suspect_name">Suspect Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="suspect_name" class="form-control" placeholder="Enter Suspect Name" name="suspect_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="suspect_age">Suspect Age</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" min="0" id="suspect_age" class="form-control" placeholder="Enter Suspect Age" name="suspect_age">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="place_of_crime">Place of Crime</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" min="0" id="place_of_crime" class="form-control" placeholder="Enter Place of Crime" name="place_of_crime">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="date_of_crime">Date of Crime</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" id="date_of_crime" class="form-control" placeholder="Please choose a date..." name="date_of_crime">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                     <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="time_of_crime">Time of Crime</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" min="0" id="time_of_crime" class="form-control timepicker" placeholder="Enter Time of Crime" name="time_of_crime">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="evidence_photo">Evidence Upload</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <input type="file" class="form-control" name="evidence_photo">
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
            <!-- #END# Horizontal Layout -->
    </div>
</section>

 <?php include 'footer.php'?>
