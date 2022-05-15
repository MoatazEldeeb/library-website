<?php
    include "config/db_connect.php";

    if(isset($_GET['id'])){

        $memberId = $_GET['id'];

        $sql = "SELECT id, firstName, lastName, email, pass FROM members WHERE id=$memberId";

        $result = mysqli_query($conn,$sql);

        $member = mysqli_fetch_assoc($result);

    }

    if(isset($_POST['edit'])){
        $memberId = $_POST['id_to_edit'];

        $newFirstName = mysqli_real_escape_string($conn,$_POST['firstName']);
        $newLastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $newEmail = mysqli_real_escape_string($conn,$_POST['email']);
        $newPass = mysqli_real_escape_string($conn,$_POST['pass']);

        $sql = "UPDATE members SET firstName= '$newFirstName', lastName='$newLastName', email='$newEmail', pass='$newPass' WHERE id = $memberId ";

        if(mysqli_query($conn,$sql)){
            header('Location: home.php');
        }else{
            echo 'query error: '. mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
        <div class="login-container">
                <form action="memberDetails.php" method="POST">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" value="<?php echo $member['firstName']?>">
                    
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" value="<?php echo $member['lastName']?>">
                    <br>
                    <label for="email">Email</label>
                    <br>
                    <input type="text" name="email" value="<?php echo $member['email']?>">
                    <br>
                    <label for="pass">Password</label>
                    <br>
                    <input type="text" name="pass" value="<?php echo $member['pass']?>">
                    <br>
                    <input type="submit" name="edit" value= "Edit">
                    <input type="hidden" name="id_to_edit" value="<?php echo $memberId;?>">
                </form>
        </div>
  

    <?php include 'templates/footer.html';?>
</html>