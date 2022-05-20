<?php
    include "config/db_connect.php";
    session_start();
    
    
    if(isset($_POST['add'])){

        $id_to_edit = $_POST['id_to_edit'];
        $newTitle = mysqli_real_escape_string($conn,$_POST['title']);
        $newAuthor = mysqli_real_escape_string($conn,$_POST['author']);
        $newCategory = mysqli_real_escape_string($conn,$_POST['category']);
        $newDescription = mysqli_real_escape_string($conn,$_POST['description']);
        $newImage = mysqli_real_escape_string($conn,$_POST['image']);


        $sql = "INSERT INTO books(title,author,category,description,cover) VALUES ('$newTitle', '$newAuthor' ,'$newCategory','$newDescription','$newImage')";

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
    <div class= "container">
        <div class="books-container">
            <div class="book-card">
                
                <form action="addBook.php" method="POST">
                    <label for="image">Image URL</label>
                    <br>
                    <input type="text" name="image" value="">
                    <br>

                    <label for="title">Title</label>
                    <br>
                    <input type="text" name="title" value="">
                    <br>

                    <label for="author">Author</label>
                    <br>
                    <input type="text" name="author" value="">
                    <br>

                    <label for="category">Category</label>
                    <br>
                    <input type="text" name="category" value="">
                    <br>

                    <label for="description">Discription</label>
                    <br>
                    <textarea name="description" rows="10" cols= "83"></textarea>
                    <br>

                    <input type="submit" name="add" value= "Add">
                </form>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.html';?>
</html>