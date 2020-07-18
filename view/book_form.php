<?php include 'view/header.php'; ?>
<h4>Book Information</h4>
<hr>
        <form method="POST" action="">
            <input type="hidden" name="id" id="id" value="<?php echo ISSET($id) ? $id : ''; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input maxlength="30" type="text" name="title" required="" class="form-control col-md-4" id="title" value="<?php echo ISSET($title) ? $title : ''; ?>">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input maxlength="30" type="text" name="author" required="" class="form-control col-md-4" id="author" value="<?php echo ISSET($author) ? $author : ''; ?>">
            </div>
            <div class="form-group">
                <label for="date_published">Date Published</label>
                <input maxlength="8" type="date" name="date_published" placeholder='YYYY-MM-DD' required="" class="form-control col-md-4" id="date_published" value="<?php echo ISSET($date_published) ? $date_published : ''; ?>">
            </div>
            <?php if ($edit_flag == TRUE): ?>
                <button class="btn btn-warning" type="submit" name="edit_save" >Submit</button>
            <?php else: ?>
                <button class="btn btn-warning" type="submit" name="add_save" >Submit</button>
            <?php endif ?>
        </form>
<?php include 'view/footer.php'; ?>
