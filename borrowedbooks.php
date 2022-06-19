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
        <div id="return-book" >Please return the book that is due.</div>
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
    
    <script>
        let returnBookDiv = document.getElementById("return-book");
        var books = <?php echo json_encode($books);?>;
        
        

        for(let i =0;i<books.length;i++)
        {
            if(datePassed(books[i]["returnDate"])=== true){
                returnBookDiv.style.display = "block";
            }
        }

        function datePassed(date){

            var y= parseInt(date.slice(0,4));
            var m = parseInt(date.slice(6,7));
            var d=  parseInt(date.slice(8,10));

            var today = new Date();
            var d1 = parseInt(String(today.getDate()).padStart(2, '0'));
            var m1 = parseInt(String(today.getMonth() + 1).padStart(2, '0')); //January is 0!
            var y1 = parseInt(today.getFullYear());

            console.log(y1+"-"+m1+"-"+d1)
            console.log(y+"-"+m+"-"+d)
            if(y < y1)
            {
                console.log("years");
                return true;
            }
            else if(m < m1){
                console.log("months");
                return true;
            }
            else if(d < d1 ){
                console.log("day");
                return true;
            }
            return false;
           
            
        }

    </script>

<?php include 'templates/footer.html';?>

</html>