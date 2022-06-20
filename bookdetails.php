<?php
    include "config/db_connect.php";

    session_start();

    if(isset($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
        $sql = "DELETE FROM books WHERE book_id = $id_to_delete";

        if(mysqli_query($conn,$sql)){
            header('Location: home.php');
        }else{
            echo 'query error: '. mysqli_error($conn);
        }

        $result = mysqli_query($conn,$sql);

        $book = mysqli_fetch_assoc($result);

    }
    

    if(isset($_POST['edit'])){

        $id_to_edit = $_POST['id_to_edit'];
        $newTitle = mysqli_real_escape_string($conn,$_POST['title']);
        $newAuthor = mysqli_real_escape_string($conn,$_POST['author']);
        $newCategory = mysqli_real_escape_string($conn,$_POST['category']);
        $newDescription = mysqli_real_escape_string($conn,$_POST['description']);

        $sql = "UPDATE books SET title= '$newTitle', author='$newAuthor', category='$newCategory', description='$newDescription' WHERE book_id = $id_to_edit";

        if(mysqli_query($conn,$sql)){
            header('Location: home.php');
        }else{
            echo 'query error: '. mysqli_error($conn);
        }
    }


    if(isset($_POST['view'])){
        $bookID= $_POST['id_to_view'];
        
        $sql = "SELECT * FROM books WHERE book_id = $bookID";

        $result = mysqli_query($conn,$sql);

        $book = mysqli_fetch_assoc($result);

        //freeing result and closing connection
        mysqli_free_result($result);
        mysqli_close($conn);
    }


?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <div class= "container">
        <div class="books-container">
            <div class="book-card">
                <img src=<?php echo $book['cover'] ?> alt="Image failed to load" width="250px">
                <form action="bookdetails.php" method="POST">
                    <label for="title">Title</label>
                    <br>
                    <input type="text" name="title" value="<?php echo $book['title']?>">
                    <br>
                    <label for="author">Author</label>
                    <br>
                    <input type="text" name="author" value="<?php echo $book['author']?>">
                    <br>
                    <label for="category">Category</label>
                    <br>
                    <input type="text" name="category" value="<?php echo $book['category']?>">
                    <br>
                    <label for="description">Discription</label>
                    <br>
                    <textarea name="description" rows="10" cols= "83"><?php echo $book['description'];?></textarea>
                    <br>
                    <input type="submit" name="edit" value= "Edit">
                    <input type="hidden" name="id_to_edit" value="<?php echo $bookID;?>">
                    <input type="submit" name= "delete" value="Delete"> 
                </form>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.html';?>
</html>