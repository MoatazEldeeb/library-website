<?php
    include "config/db_connect.php";

    session_start();


    $sql = "SELECT book_id, title, author, description, cover, category, borrowed_by,borrowDate,returnDate FROM books";

    $result = mysqli_query($conn,$sql);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);




    if(isset($_POST['borrow'])){
        $id_to_borrow = mysqli_real_escape_string($conn,$_POST['id_to_borrow']);
        $userID = $_GET['id'];

        $borrowDate = date("Y-m-d");
        $returnDate = date('Y-m-d', strtotime('+7 days'));
        

        $sql = "UPDATE books SET borrowed_by='$userID', borrowDate='$borrowDate', returnDate= '$returnDate'  WHERE book_id= $id_to_borrow ";

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
            <?php if(isset($_GET['id'])): ?>
                <?php if($_GET['id']!=1):?>
                    <div class="search-bar">
                        <label for="textSearch">Search: </label>
                        <input type="text" id="textSearch">
                        <button id="search-btn" onclick="search()"><img id="search-icon" src="images/search-icon.png" alt="?"></button>

                    </div>
                <?php endif;?>
            <?php endif;?>
        
            <?php foreach($books as $book): ?>
                <?php if(isset($_GET['id'])): ?>
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
                                <?php if($book['borrowed_by']!=0):?>
                                    <?php 
                                        include "config/db_connect.php";

                                        $borrowedby = $book['borrowed_by'];

                                        $sql = "SELECT firstName, lastName FROM members WHERE id=$borrowedby ";

                                        $result = mysqli_query($conn,$sql);
                                    
                                        $member = mysqli_fetch_assoc($result);

                                        $memberName = $member['firstName'] . ' '. $member['lastName'];
                                        
                                        mysqli_free_result($result);
                                        mysqli_close($conn);
                                    ?>
                                    <p>Borrowed by: <?php echo $memberName ?></p>
                                    <p class="borrow-els">Borrow Date: <?php echo $book['borrowDate'] ?></p>
                                    <p class="return-els">Return Date: <?php echo $book['returnDate'] ?></p>
                                <?php endif;?>
                                <p><?php echo $book['description'];?></p>
                                
                                <form action="bookdetails.php" method="POST">
                                    <input type="hidden" name="id_to_view" value="<?php echo $book['book_id'];?>">
                                    <input type="submit" name= "view" value="Edit"> 
                                </form>
                            </div>
                    <?php endif;?>
                <?php else:?>
                    <?php if($book['borrowed_by']==0):?>
                            <div class="book-card">
                                <img src=<?php echo $book['cover'];?> alt="Cover not found" width="200px">
                                <h3><?php echo $book['title'];?></h3>
                                <h4><?php echo $book['author'];?></h4>
                                <p><?php echo $book['category'];?></p>
                                <p><?php echo $book['description'];?></p>
                                
                                <p>Login to Borrow</p>
                            </div>
                        <?php endif;?>
                <?php endif;?>
            <?php endforeach;?>
        </div>

        
            
    </div>
    <script type="text/javascript">
        const searchEl = document.getElementById("textSearch");
        let booksContainerEl = document.getElementsByClassName("books-container")[0];
        let books = <?php echo json_encode($books);?>;
        
        // console.log(books[0])
        // let isMember = <?php echo isset($_GET['id'])?>
        // if(isMember){
        //     let memberId = <?php echo $_GET['id']?>
        // }
        
        function search()
        {
            booksContainerEl.innerHTML = ""
            booksContainerEl.innerHTML +=
                    `
                    <div class="search-bar">
                        <label for="textSearch">Search: </label>
                        <input type="text" id="textSearch">
                        <button id="search-btn" onclick="search()"><img id="search-icon" src="images/search-icon.png" alt="?"></button>

                    </div>`;
            for(let i=0; i< books.length;i++)
            {

                if((books[i]['title'].toLowerCase()).includes(searchEl.value.toLowerCase()) && books[i]['borrowed_by'] =="0")
                {
                    
                    booksContainerEl.innerHTML +=
                    `
                    <div class="book-card">
                        <img src=${books[i]['cover']} alt="Cover not found" width="200px">
                        <h3>${books[i]['title']}</h3>
                        <h4>${books[i]['author']}</h4>
                        <p>${books[i]['category']}</p>
                        <p>${books[i]['description']}</p>
                        
                        <form action="allbooks.php?id=<?php echo $_GET['id']?>" method="POST">
                            <input type="hidden" name="id_to_borrow" value="${books[i]['book_id']}">
                            <input type="submit" name= "borrow" value="Borrow"> 
                        </form>
                    </div >
                    `;
                }
            }
                
        }

    </script>
<?php include 'templates/footer.html';?>

</html>