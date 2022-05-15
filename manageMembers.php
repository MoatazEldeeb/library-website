<?php
    include "config/db_connect.php";

    session_start();
    $isLoggedin = isset($_SESSION['isLoggedin']);


    $sql = "SELECT id, firstName, lastName, email, isAdmin FROM members";

    $result = mysqli_query($conn,$sql);

    $members = mysqli_fetch_all($result, MYSQLI_ASSOC);

    


    if(isset($_SESSION['isLoggedin'])){
        $isLoggedin = true;
        $_SESSION['isLoggedin']= true;
    }


    
    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <div>
        <div class="books-container">
            
        
            <?php foreach($members as $member): ?>
                
                <p>Name: <?php echo $member['firstName'] ." ". $member['lastName'] ;?></p>
                
                <p>Email: <?php echo $member['email'];?></p>
                <?php
                    include "config/db_connect.php";
                    $memberId = $member['id'];
                    $sql = "SELECT book_id, title FROM books WHERE borrowed_by= $memberId";

                    $result = mysqli_query($conn,$sql);

                    $booksBorrowed = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    mysqli_free_result($result);
                    mysqli_close($conn);

                ?>
                <p>Books Borrowed:</p>
                <ul class="books-list">
                    <?php foreach($booksBorrowed as $book):?>
                        <li><?php echo $book['title'];?></li>
                    <?php endforeach;?>
                </ul>
                <hr>
                

            <?php endforeach;?>
        </div>
        <script type="text/javascript" src="dateformat.js"></script>
            
    </div>

<?php include 'templates/footer.html';?>

</html>