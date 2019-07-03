<?php

/**
 * Created by PhpStorm.
 * User: Sandip
 * Date: 9/27/2018
 * Time: 11:35 PM
 */
require 'bin/functions.php';
require 'db_configuration.php';


$query = "SELECT * FROM training_enrollment";

$GLOBALS['tableResults'] = mysqli_query($db, $query);
$GLOBALS['customerTableResults'] = mysqli_query($db, $query);
$GLOBALS['gridResults'] = mysqli_query($db, $query);


?>

<?php $page_title = 'Training Table'; ?>
<?php include('header.php'); ?>

<!-- Page Content -->
<div class="container-fluid">
    <?php
            if(isset($_GET['updatedRoster'])){
                if($_GET["updatedRoster"] == "Success"){
                    echo '<br><h3>Success! The Training Schedule has been updated!</h3>';
                }
            }

    ?>
    <!-- Page Heading -->
    <h1 class="my-4">
        <?php
        //Display Admin view if an admin is logged in.
        //This gives full access to all CRUD functions
        
        ?>
    </h1>
    
    <div id="customerTableView">
        <button><a class="btn btn-sm" href="updateRoster.php">Update Roster</a></button>
        <table class="table table-striped" id="ceremoniesTable">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>Enrollment Number</th>
                    <th>Training ID</th>
                    <th>Employee Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($customerTableResults->num_rows > 0) {
                    // output data of each row
                    while($row = $customerTableResults->fetch_assoc()) {

                        echo    '<tr>
                                    <td>'.$row["enrollment_no"].'</td>
                                    <td>'.$row["training_id"].' </span> </td>
                                    <td>'.$row["employee_email"].'</td>
                                </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else
                ?>
                </tbody>
            </div>
        </table>
    </div>
</div>

<!-- /.container -->
<!-- Footer -->
    <footer class="page-footer text-center">
        <p>Assignment 7 by Alex Rader</p>
    </footer>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        $('#tableResults').DataTable( {
            dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv' , 'pdf'
                ] }
        );

        $('#ceremoniesTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );
    } );
</script>
</body>
</html>
