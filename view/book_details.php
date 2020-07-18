<?php include 'view/header.php'; ?>
<h4>BOOK INFORMATION</h4>
<hr>
    <h5><b>Title:</b> <?php echo $book['title']; ?></h5>
    <h5><b>Author:</b> <?php echo $book['author']; ?></h5>
    <h5><b>Date Pubished:</b> <?php echo $book['date_published']; ?></h5>
    <br>
    <a href="index.php?display=edit&id=<?php echo $id; ?>" type="button" class="btn btn-primary">Edit Information</a>
    <a href="index.php?display=delete&id=<?php echo $id; ?>" type="button" onClick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger">Delete</a>
<?php include 'view/footer.php'; ?>