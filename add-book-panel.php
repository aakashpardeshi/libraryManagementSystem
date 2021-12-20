<?php
    include('header.html');
   include('config.php');

   function populateCategory(){
    $pdo = $GLOBALS['pdo'];

     //prepare a call
     $query = $pdo->prepare('SELECT c_id, c_name FROM book_category');

    //execute the sql
    $query->execute();

    echo '<div class="form-group">';
    echo '<label for="category">Choose a category * </label> </br>';
    echo '<select class="form-control" name="category" id="category">';
    while($result = $query->fetch()){
        echo '<option value="'.$result["c_id"].'">'.$result["c_name"].'</option>';
    }
    echo '</select>';
    echo '</div>';

}

function populatePublisher(){
    $pdo = $GLOBALS['pdo'];

    //prepare a call
    $query = $pdo->prepare('SELECT p_id, p_name FROM publisher');

    //execute the sql
    $query->execute();

    echo '<div class="form-group">';
    echo '<label for="pub">Choose a publisher * </label> </br>';
    echo '<select class="form-control" name="pub" id="pub">';
    while($result = $query->fetch()){
        echo '<option value="'.$result["p_id"].'">'.$result["p_name"].'</option>';
    }
    echo '</select>';
    echo '</div>';
}
?>

<body>
<div class="container">
       <div class="row">
            <h5>Add Book</h5>   
            
        </div>
        <br/>
        <div class="row">
        <form class="form" method="POST" action="add-book.php">

            <div class="form-group">
                <label for="bname">Book Name *:</label>
                <input type="text" class="form-control" name="bname" placeholder="Enter Book Name" required>
            </div>
            <div class="form-group">
                <label for="bprice">Price *:</label>
                <input type="text" class="form-control" name="bprice" placeholder="Enter Book price" required>
            </div>
            <div class="form-group">
                <label for="pubYear">Publish Year *:</label>
                <input type="text" class="form-control" name="pubYear" placeholder="Publish Year" required>
            </div>
            <div class="form-group">
                <label for="copies">Total copies *:</label>
                <input type="number" class="form-control" name="copies" placeholder="Total copies" default = 0 required>
            </div>
            <div class="form-group">
                <label for="bauthor">Book Author *:</label>
                <input type="text" class="form-control" name="bauthor" placeholder="Enter Book Author" required>
            </div>
            <?php populateCategory(); 
                populatePublisher();
                echo "</br>";
            ?>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
</div>
</body>