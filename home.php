<?php
    include "config/db_connect.php";

    session_start();

    $member = ['firstName'=>'Guest','lastName'=>'','email'=>'','password'=>'','isAdmin'=> 0];

    
    $isLoggedin =false;
    if(isset($_SESSION['id'])){
        $isLoggedin = true;
        $_SESSION['isLoggedin']= true;
    }


    // $_SESSION['isLoggedin']= $isLoggedin;

    if($isLoggedin){

        $id = mysqli_real_escape_string($conn,$_SESSION['id']);
        
        // make sql
        $sql = "SELECT * FROM members WHERE id = $id";

        //get query result
        $result = mysqli_query($conn,$sql);

        //fetch result in array
        $member = mysqli_fetch_assoc($result);

        //freeing result and closing connection
        
    }

    if($member['isAdmin']==1 ){
        // make sql
        $sql = "SELECT book_id, title, author, category FROM books ORDER BY created_at";

        //get query result
        $result = mysqli_query($conn,$sql);

        //fetch result in array
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //freeing result and closing connection
        mysqli_free_result($result);
        mysqli_close($conn);
    }
    


?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>

    <?php if($member['isAdmin'] ==1 && $isLoggedin):?>
    <!-- Admin Page -->
    <?php echo 'Hello Admin'?>
    <div>
        <ul class="user-options">
            <li  class="user-book" >
                <a href="allbooks.php?id=<?php echo $member['isAdmin'];?>">View Books</a>
            </li>
            <li class="user-book">
                <a href="addBook.php" >Add Book</a>
            </li>
        </ul>
        
        
    </div>

    <?php elseif($member['isAdmin'] ==0 && $isLoggedin): ?>
        <?php echo 'Hello '. $member['firstName']; ?>
    <!-- User Page -->
    <ul class="user-options">
        <li id="mybooks-el" class="user-book" >
            <a href="borrowedbooks.php?id=<?php echo $member['id'];?>">My books</a>
        </li>
        <li id="available-books-el" class="user-book">
            <a href="allbooks.php?id=<?php echo $member['id'];?>" >Available books</a>
        </li>
    </ul>
    
    <?php else: echo 'Hello Guest';?>
    <ul class="user-options">
        <li id="available-books-el" class="user-book">
            <a href="allbooks.php" >Available books</a>
        </li>
    </ul>

    <?php endif;?>
    <?php include 'templates/footer.html';?>
</html>
