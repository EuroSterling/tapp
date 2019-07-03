<?php

include_once 'db_configuration.php';
include_once 'updateTheRoster.php';

if (isset($_POST['adminPass'])){

    $adminPass = mysqli_real_escape_string($db, $_POST['adminPass']);
    $id = mysqli_real_escape_string($db, $_POST['trainingID']);
    $email = explode(PHP_EOL, $_POST['emails']);
    $validate = true;
    $validate = emailValidate($email);
    
    if($adminPass == "123"){
        if($validate){
            
            $update = "UPDATE training_calendar 
                    SET training_status='completed' 
                    WHERE training_id = '$id' AND training_status = 'scheduled'
                    ";
            mysqli_query($db, $update);
            for($a=0;$a<count($email);$a++){
                
                $result2 = $db->query("SELECT * FROM training_enrollment WHERE training_id='$id'AND employee_email='$email[$a]'");
                if($results->row_count ==0){
                    $sql = "INSERT INTO training_enrollment(training_id,employee_email)
                            VALUES ('$id','$email[$a]')
                            ";

                    mysqli_query($db, $sql);
                    header('location: index.php?updatedRoster=Success');
                } else{
                    return;
                }
            }
        }
            
        else{
            header('location: updateRoster.php?updatedRoster=emailFailed');
        }
    }
    else{
        header('location: updateRoster.php?updatedRoster=Failed');
    }

}//end if

function emailValidate($email){
    $b = 0;
    for($a=0; $a < count($email); $a++){
        print_r($email[$a]);
        if (filter_var($email[$a], FILTER_VALIDATE_EMAIL)) {
            $b = $b + 0;
            
        } else {
            $b = $b + 1;
            
        }
    
    }
    if ($b > 0){
        return false;
    } else{
        return true;
    }
}
?>