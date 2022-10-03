<?php include 'header.php'?>
<?php include 'config.php' ?>

<?php
// $sql = "SELECT * FROM contactdata";
// $result = mysqli_query($conn, $sql);

?>
<section class="content">
        <div class="container-fluid">
<!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               TABLE
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Conatct</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while($data = $result->fetch_array()) {
                                            echo '
                                                <tr>
                                                    <td>'.$data['contactid'].'</td>
                                                    <td>'.$data['name'].'</td>
                                                    <td>'.$data['email'].'</td>
                                                    <td>'.$data['contact'].'</td>
                                                    <td>'.$data['address'].'</td>
                                                    <td><button onclick="edit('.$data['contactid'].')">Edit</button></td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
    </div>
</section>
<script type="text/javascript">
   function edit(data){
    alert(data);
    }
</script>
 <?php include 'footer.php'?>
