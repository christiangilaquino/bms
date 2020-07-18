<?php

/**
 * This class is for Books Controller
 *
 * @author christian
 */

class common_model {
    
    private $connect = NULL;

    public function __construct(){
        $this->connect = mysqli_connect("localhost","root","Default@123","my_project"); 
    }

    /**
     * Select all record from table book_info
     *
     * @return - array
     */
    public function selectAll() {

        $result = mysqli_query($this->connect,"SELECT * FROM book_info ");
        
        $books = array();

        while (($obj = mysqli_fetch_array($result)) != NULL )
        {
            $books[] = $obj;
        }

        return $books;

    }
    
    /**
     * Select specific record from table book_info based on id
     *
     * @param $id - required. ID of retrieving record 
     * @return $book_info - Returns records retrieved.
     */
    public function selectById($id) {      

        $dbId       = mysqli_real_escape_string($this->connect,$id);

        $result     = mysqli_query($this->connect, "SELECT * FROM book_info WHERE id=$dbId");

        $book_info  = mysqli_fetch_array($result);

        return $book_info;
		
    }
    
    /**
     * Insert record information to table book_info
     *
     * @param $title - required. Book Title 
     * @param $author - required. Author name
     * @param $date_published - required. Date of Book Published
     * @param $last_modified - optional. Last modified date of book information
     */
    public function insert( $title, $author, $date_published, $last_modified = NULL ) {

        $title          = !EMPTY($title) ? mysqli_real_escape_string($this->connect,$title) : NULL;
        $author         = !EMPTY($author) ? mysqli_real_escape_string($this->connect,$author) : NULL;
        $date_published = !EMPTY($date_published) ? mysqli_real_escape_string($this->connect,$date_published) : NULL;
        $status         = 'ACTIVE';
        
        mysqli_query($this->connect, "INSERT INTO book_info (title, author, date_published, last_modified, status) VALUES ('$title', '$author', '$date_published', NULL, 'active')");
    }

    /**
     * Update a record from table book_info
     *
     * @param $id - required. ID of a record
     * @param $title - required. Book Title 
     * @param $author - required. Author's name
     * @param $date_published - required. Date of Book Published
     * @param $last_modified - optional. Last modified date of book information
     */
    public function update( $id, $title, $author, $date_published, $last_modified = NULL ) {

        $title          = !EMPTY($title) ? mysqli_real_escape_string($this->connect,$title) : NULL;
        $author         = !EMPTY($author) ? mysqli_real_escape_string($this->connect,$author) : NULL;
        $date_published = !EMPTY($date_published) ? mysqli_real_escape_string($this->connect,$date_published) : NULL;
        $status         = 'ACTIVE';
        

        mysqli_query($connect, "UPDATE book_info SET title='$title', author='$author', date_published = '$date_published', last_modified = '$last_modified' WHERE id=$id");
    }
    
    /**
     * Delete a record from table book_info
     *
     * @param $id - required. ID of a record
     */
    public function delete($id) {
        $dbId       = mysqli_real_escape_string($this->connect, $id);
        mysqli_query($connect,"DELETE FROM book_info WHERE id=$dbId");
    }
}

?>