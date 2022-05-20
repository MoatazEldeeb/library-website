<?php
    include "config/db_connect.php";

    $email ="";
    $pass = "";
    $isAdmin = 0;
    $id = 0;
    // session_destroy();
    session_start();

    unset($_SESSION['id']);

    $errors = array('email'=>'','password'=> '', 'validation'=>'');

    $sql= "SELECT id, email, pass ,isAdmin FROM members ";

    $result = mysqli_query($conn,$sql);

    $members = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);



    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors['email'] = "an email is required <br/>";
        }else{
            $email= $_POST['email'];
            

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $errors['email'] ="Email not Valid! <br/>";
                
                // if()
            }
        }

        if(empty($_POST['password'])){
            $errors['password'] = "Enter your password <br/>";
        }else{
            $pass = $_POST['password'];
            // if(){
        }

        if(!array_filter($errors)){
            foreach($members as $member){
                if($member['email']==$email && $member['pass']==$pass ){
                    $isAdmin = $member['isAdmin'];
                    $id = $member['id'];
                    $errors['validation']= '';
                    break;
                }elseif ($member['email'] != $email || $member['pass'] != $pass ){
                    $errors['validation'] = 'Email or Password is incorrect, try again!';
                    // echo $member['pass'] . ' is not ' . $pass;
                    
                }
            }

            if(!array_filter($errors))
            {
                session_start();
                $_SESSION['id']= $id;
                if($isAdmin == 1){
                //User is Valid and Admin
                $_SESSION['isLoggedin'] = true;
                header('Location: home.php');
                }
                else
                {
                    //User is valid and NOT Admin
                    header('Location: home.php');
                }
            }
        }
    }

    
?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
        <div class="login-container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="login-form">
                <h4 >Login</h4>

                <input type="email" name="email" value="" placeholder="Email">
                <div class= "red-text"><?php echo $errors['email']?></div>

                <input type="password" name="password" value="" placeholder="Password">
                <div class= "red-text"><?php echo $errors['password']?></div>

                <label> Don't have an account? </label>
                <a href="signup.php">Sign up</a>

                <p><?php echo $errors['validation']?></p>
                <div>
                    <input type ="submit" name="submit" value="Submit" >
                </div>


            </form>
        </div>
    <?php include 'templates/footer.html';?>
</html>