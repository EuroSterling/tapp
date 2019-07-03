<?php
/**
 * Created by PhpStorm.
 * User: Sandip
 * Date: 9/28/2018
 * Time: 11:18 PM
 */
?>


<?php $page_title = 'Update Roster'; ?>
<?php include('header.php'); ?>
<?php 
    $mysqli = NEW MySQLi('localhost','root','','training');
    $resultset = $mysqli->query("SELECT DISTINCT training_id FROM training_calendar WHERE training_status='scheduled' ORDER BY training_id ASC");   
?>

<div class="container">
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    if(isset($_GET['updatedRoster'])){
        if($_GET["updatedRoster"] == "Failed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - The Admin Password is Inncorrect Please try Again!</h3>';
        }
        if($_GET["updatedRoster"] == "emailFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - One or More of Your Email Addresses are Invlaid, Please Try Again!</h3>';
        }
    }

    ?>
    <form action="updateTheRoster.php" method="POST">
        <br>
        <h3 text-align="center">Update Roster </h3> <br>
        <div align="center" class="form-group col-md-8">
                <label for="safe_link">Admin Password</label>
                <input type="text"  name="adminPass" maxlength="10" size="10" required title="Please enter the Admin password before changes can be made.">
        </div>

        <div align="center" class="form-group col-md-8">
            <label for="safe_link">Training ID</label><br>
            <select name="trainingID">
            <?php 
            while($rows = $resultset->fetch_assoc()){
                $trainingID=$rows['training_id']; 
                echo"<option Value='$trainingID'>$trainingID</option>";}?>
            </select>
        </div>

            
        <div align="center" class="form-group col-md-8">
                <label for="safe_link">Email/s</label>
                <textarea type="email" class="form-control" name="emails"  rows="10" maxlength="500" required title="Please enter a list of emails one per line."></textarea>
        </div>
        
        <br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Submit Update</button>
        </div>
        <br> <br>

    </form>
</div>

