<?php
    include "config/db_connect.php";

    session_start();
    $isLoggedin = isset($_SESSION['isLoggedin']);


    $sql = "SELECT book_id, title, author, description, cover, category, borrowed_by FROM books";

    $result = mysqli_query($conn,$sql);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if(isset($_SESSION['isLoggedin'])){
        $isLoggedin = true;
        $_SESSION['isLoggedin']= true;
    }


    if(isset($_POST['borrow'])){
        $id_to_borrow = mysqli_real_escape_string($conn,$_POST['id_to_borrow']);
        $userID = $_GET['id'];

        $borrowDate = date("Y-m-d");
        $returnDate = date('Y-m-d', strtotime('+7 days'));
        
        $borrowDate = explode('-', $borrowDate);
        $borrowDate = implode("", $borrowDate);

        $returnDate = explode('-', $returnDate);
        $returnDate = implode("", $returnDate);

        $sql = "UPDATE books SET borrowed_by=$userID, borrowDate=$borrowDate, returnDate= $returnDate  WHERE book_id= $id_to_borrow ";

        if(mysqli_query($conn,$sql)){
            header('Location: home.php');
        }else{
            echo 'query error: '. mysqli_error($conn);
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <div>
        <div class="books-container">
            <?php foreach($books as $book): ?>
                <?php if($_GET['id']!=1):?>
                    <?php if($book['borrowed_by']==0):?>
                        <div class="book-card">
                            <img src=<?php echo $book['cover'];?> alt="Cover not found" width="200px">
                            <h3><?php echo $book['title'];?></h3>
                            <h4><?php echo $book['author'];?></h4>
                            <p><?php echo $book['category'];?></p>
                            <p><?php echo $book['description'];?></p>
                            
                            <form action="allbooks.php?id=<?php echo $_GET['id']?>" method="POST">
                                <input type="hidden" name="id_to_borrow" value="<?php echo $book['book_id'];?>">
                                <input type="submit" name= "borrow" value="Borrow"> 
                            </form>
                        </div>
                    <?php endif;?>
                <?php else:?>
                    <div class="book-card">
                            <img src=<?php echo $book['cover'];?> alt="Cover not found" width="200px">
                            <h3><?php echo $book['title'];?></h3>
                            <h4><?php echo $book['author'];?></h4>
                            <p><?php echo $book['category'];?></p>
                            <p><?php echo $book['description'];?></p>
                            <form action="bookdetails.php" method="POST">
                                <input type="hidden" name="id_to_view" value="<?php echo $book['book_id'];?>">
                                <input type="submit" name= "view" value="Edit"> 
                            </form>
                        </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
            
            
    </div>

<?php include 'templates/footer.html';?>

</html>