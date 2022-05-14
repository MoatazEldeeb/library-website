<?php
    include "config/db_connect.php";

    session_start();

    $userID = $_GET['id'];

    $sql = "SELECT book_id, title, author, description, cover, category, borrowDate, returnDate FROM books WHERE borrowed_by=$userID";

    $result = mysqli_query($conn,$sql);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
            <?php foreach($books as $book): ?>
                    <div class="book-card">
                        <img src=<?php echo $book['cover'];?> alt="Cover not found" width="200px">
                        <h3><?php echo $book['title'];?></h3>
                        <h4><?php echo $book['author'];?></h4>
                        <p><?php echo $book['category'];?></p>

                        <p id="borrow-el">Borrow Date: <?php echo $book['borrowDate'];?></p>
                        <p id= "return-el">Return Date: <?php echo $book['returnDate'];?></p>
                        <p><?php echo $book['description'];?></p>
                        
                    </div>
                    
            <?php endforeach;?>
            <script type="text/javascript">
                        
                const borrowEl = document.getElementById("borrow-el")
                const returnEl = document.getElementById("return-el")

                let borrowDate = borrowEl.innerText 
                let returnDate = returnEl.innerText

                borrowDate = borrowDate.split(/(:+)/)[2]
                returnDate = returnDate.split(/(:+)/)[2]

                borrowDate = borrowDate.slice(0,5 ) + "-"+ borrowDate.slice(5, 7) +"-"+borrowDate.slice(7, 9)
                returnDate = returnDate.slice(0,5 ) + "-"+ returnDate.slice(5, 7) +"-"+returnDate.slice(7, 9)

                borrowEl.innerText = "Borrow Date: " + borrowDate
                returnEl.innerText = "Return Date: " + returnDate
            </script>
            
        </div>
            
            
    </div>

<?php include 'templates/footer.html';?>

</html>