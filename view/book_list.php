<?php include 'view/header.php'; ?>
<div>

    <h2>Books</h2>

    <?php 
    //IF(ISSET($_SESSION['message'])) { ?>
    <!-- <div class="alert alert-success" role="alert"> -->
      <?php //echo $_SESSION['message']; ?>
      <?php //unset($_SESSION['message']); ?>
    <!-- </div> -->
    <?php //} 
    ?>

    <a href="index.php?display=create" type="button" class="btn btn-danger float-right ">Add Book</a>
<br>
<br>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="d-flex">
            <th class="col-3 text-center"> Date Published </th>
            <th class="col-3 text-center"> Author Name</th>
            <th class="col-2 text-center"> Book Title </th>
            <th class="col-1 text-center"> &nbsp; </th>
            <th class="col-1 text-center"> &nbsp; </th>
            <th class="col-2 text-center"> &nbsp; </th>
        </tr>
    </thead>
    <tbody>
    <?php if(!EMPTY($books)){ ?>
    <?php foreach ($books as $book): ?>
        <tr class="d-flex">
            <td class="col-3 text-center"><?php echo $book['date_published']; ?></td>
            <td class="col-3 text-center"><?php echo $book['author']; ?></td>
            <td class="col-2 text-center"><?php echo $book['title']; ?></td>
            <td class="col-1 text-center" class="col-md-1"><a type="button" onClick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger" href="index.php?display=delete&id=<?php echo $book['id']; ?>">Delete</a></td>
            <td class="col-1 text-center"><a type="button" class="btn btn-primary" href="index.php?display=edit&id=<?php echo $book['id']; ?>">Edit Post</a></td>
            <td class="col-2 text-center"><a type="button" class="btn btn-primary" href="index.php?display=details&id=<?php echo $book['id']; ?>">View Details</a></td>
            
        </tr>
    <?php endforeach; ?>
    <?php }else{ ?>
        <tr class="d-flex">
            <td colspan="12">No data Available</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php include 'view/footer.php'; ?>