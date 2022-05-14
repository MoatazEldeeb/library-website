<?php

    include "config/db_connect.php";

    $email ="";
    $fName = "";
    $lName = "";
    $pass = "";
    

    $errors = array('email'=>'','name'=>'','password'=> '', 'validation'=>'');

    if(isset($_POST['submit'])){
        //Validating Email
        if(empty($_POST['email'])){
            $errors['email'] = "Email is required <br/>";
        }else{
            $email= mysqli_real_escape_string($conn , $_POST['email']);
            

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $errors['email'] ="Email not Valid! <br/>";
                
                
            }
        }

        //Validating Password
        if(empty($_POST['password'])){
            $errors['password'] = "Password is required <br/>";
        }else{
            $pass = mysqli_real_escape_string($conn , $_POST['password']);
            
        }

        //Validating Name
        if(empty($_POST['fName']) || empty($_POST['lName']) ){
            $errors['name'] = "First Name and Last Name is required <br/>";
        }else{
            $fName = mysqli_real_escape_string($conn , ucfirst($_POST['fName']));
            $lName = mysqli_real_escape_string($conn , ucfirst($_POST['lName']));
            
        }


        if(!array_filter($errors)){

            //create sql
            $sql = "INSERT INTO members(firstName,lastName,email,pass) VALUES ('$fName', '$lName' ,'$email','$pass') ";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //success
                header('Location: login.php');
            }else{
                //error
                echo 'query error: '. mysqli_error($conn);
            }

        }
    }
?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
        <div class="login-container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <h4 >Sign Up</h4>

            
                <input type="email" name="email" value="" placeholder="Email">
                <div class= "red-text"><?php echo $errors['email']?></div>

                
                <input type="text" name="fName" value="" placeholder="First Name">

                
                <input type="text" name="lName" value="" placeholder="Last Name">
                <div class= "red-text"><?php echo $errors['name']?></div>

                <input type="password" name="password" value="" placeholder="Password">
                <div class= "red-text"><?php echo $errors['password']?></div>

                <label> Already have an account? </label>
                <a href="signup.php">Login</a>

                <p></p>
                <div>
                    <input type ="submit" name="submit" value="Submit" >
                </div>
                

            </form>
        </div>
    <?php include 'templates/footer.html';?>
</html>