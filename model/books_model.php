<?php
require_once 'model/common_model.php';
require_once 'model/ValidationException.php';


/**
 * This class is for Books controller
 *
 * @author christian
 */
class books_model {
    
    private $common_model    = NULL;
      
    public function __construct() {
        $this->common_model = new common_model();
    }
    
    /**
     * Gets all books from database table book_info
     *
     * @throws Exception
     * @return @res - Returns records retrieved.
     */

    public function get_books() {
        try {
            $res = $this->common_model->selectAll();
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Gets book information based on ID
     *
     * @param $id - required. id of a record
     * @throws Exception
     * @return array
     */
    public function get_book_by_id($id) {
        try {
            $res = $this->common_model->selectById($id);
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
        return $this->common_model->find($id);
    }
        
    /**
     * Use this function to add book record to the database table book_info
     *
     * @param $title - required. Book Title
     * @param $author - required. Book Author's name
     * @param $date_published - required. Date published of the book
     * @param $last_modified - required. Last modified date of the book information
     * @throws Exception
     */
    public function add_book( $title, $author, $date_published, $last_modified ) {
        try {
            $this->_validate($title, $author, $date_published);
            $res = $this->common_model->insert($title, $author, $date_published, $last_modified);
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Use this function to update book record from the database table book_info
     *
     * @param $title - required. Book Title
     * @param $author - required. Book Author's name
     * @param $date_published - required. Date published of the book
     * @param $last_modified - required. Last modified date of the book information
     * @return $res
     * @throws Exception
     */
    public function update_book( $id, $title, $author, $date_published, $last_modified ) {
        try {
            $this->_validate($title, $author, $date_published);
            $res = $this->common_model->update($id, $title, $author, $date_published, $last_modified);
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Use this function to delete a book record from the database table book_info
     *
     * @param $id - required. Book record ID
     * @throws Exception
     */
    public function delete_book( $id ) {
        try {
            $res = $this->common_model->delete($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Use this private function to validate book information 
     *
     * @param $title - required. Book Title
     * @param $author - required. Book Author's name
     * @param $date_published - required. Date published of the book
     * @throws ValidationException
     */
    private function _validate( $title, $author, $date_published ) {
        $errors = array();
        if ( !isset($title) || empty($title) ) {
            $errors[] = 'Title';
        }

        if ( !isset($author) || empty($author) ) {
            $errors[] = 'Author';
        }

        if ( !isset($date_published) || empty($date_published) ) {
            $errors[] = 'Date Published';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
}

?>
