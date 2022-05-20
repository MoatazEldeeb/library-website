<?php
    include "config/db_connect.php";

    session_start();

    $userID = $_GET['id'];

    $sql = "SELECT book_id, title, author, description, cover, category, borrowDate, returnDate FROM books WHERE borrowed_by=$userID";

    $result = mysqli_query($conn,$sql);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if(isset($_POST['return']))
    {
        $bookID= $_POST['id_to_return'];

        $sql = "UPDATE books SET borrowed_by= '0'WHERE book_id = $bookID";

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
                    <div class="book-card">
                        <img src=<?php echo $book['cover'];?> alt="Cover not found" width="200px">
                        <h3><?php echo $book['title'];?></h3>
                        <h4><?php echo $book['author'];?></h4>
                        <p><?php echo $book['category'];?></p>

                        <p class="borrow-els">Borrow Date: <?php echo $book['borrowDate'];?></p>
                        <p class= "return-els">Return Date: <?php echo $book['returnDate'];?></p>
                        <p><?php echo $book['description'];?></p>
                        <form action="borrowedbooks.php?id=<?php echo $userID ?>" method="POST">
                            <input type="hidden" name="id_to_return" value="<?php echo $book['book_id'];?>">
                            <input type="submit" name= "return" value="Return"> 
                        </form>
                    </div>
                    
            <?php endforeach;?>

            
        </div>
            
            
    </div>

<?php include 'templates/footer.html';?>

</html>