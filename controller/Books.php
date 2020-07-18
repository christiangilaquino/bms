<?php

require_once 'model/books_model.php';

class Books {
    
    private $books_model = NULL;
    
    public function __construct() {
        $this->books_model = new books_model();
    }
    

    /**
     * Redirect page function 
     * 
     * @param array $location - required. redirect page
     */
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    /**
     * Use this function to know which query variable will be displayed
     * 
     * @throws Exception
     */
    public function handleRequest() {
        $display = isset($_GET['display']) ? $_GET['display'] : NULL;

        try {
            if ( !$display || $display == 'list' ) {
                $this->_book_list();
            } elseif ( $display == 'create' ) {
                $this->_save_book();
            } elseif ( $display == 'edit' ) {
                $edit_flag = TRUE;
                $this->_save_book($edit_flag);
            } elseif ( $display == 'delete' ) {
                $this->_delete_book();
            } elseif ( $display == 'details' ) {
                $this->_detail_book();
            } else {
                $this->showError("Page not found", "Page for operation ".$display." was not found!");
            }
        } catch ( Exception $e ) {
            
            $this->showError("Application error", $e->getMessage());
        }
    }
    
    /**
     * Private function for listing all books
     * 
     * @throws Exception
     */
    private function _book_list() {
        $books = $this->books_model->get_books();
        
        // include 'view/book_list.php';
        include 'view/log_in.php';
        
    }
    
    /**
     * Private function for saving booking information
     * 
     * @throws Exception
     */
    private function _save_book($edit_flag = FALSE) {
       
        $header = 'Add Book Information';
        
        $title          = '';
        $author         = '';
        $date_published = '';
        $last_modified  = '';
       
        $errors = array();
        
        if ( isset($_POST['add_save']) ) {
            
            $title          = isset($_POST['title']) ? $_POST['title']  :NULL;
            $author         = isset($_POST['author']) ? $_POST['author'] :NULL;
            $date_published = isset($_POST['date_published']) ? $_POST['date_published'] :NULL;
            $last_modified  = isset($_POST['last_modified']) ? $_POST['last_modified'] :NULL;

            try {
                $this->books_model->add_book($title, $author, $date_published, $last_modified);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        if ( isset($_POST['edit_save']) ) {
            
            $id             = $_POST['id'];
            $title          = $_POST['title'];
            $author         = $_POST['author'];
            $date_published = date("Y-m-d",strtotime($_POST['date_published']));
            $last_modified  = date('Y-m-d h:i:s');

            try {
                $this->books_model->update_book($id, $title, $author, $date_published, $last_modified);
                $this->redirect('index.php?display=list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        if (($_GET['display'] == 'edit')) {
            $id             = $_GET['id'];
            $update_flag    = TRUE;

            $book_info      = $this->books_model->get_book_by_id($id);
            $title          = $book_info['title'];
            $author         = $book_info['author'];
            $date_published = $book_info['date_published'];
            $last_modified  = $book_info['last_modified'];
            $status         = $book_info['status'];
            
        }

        include 'view/book_form.php';
    }
    
    /**
     * Private function for deleting book
     * 
     * @throws Exception
     */
    private function _delete_book() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        
        $this->books_model->delete_book($id);
        $this->redirect('index.php');
    }
    
    /**
     * Private function for showing details of book
     * 
     * @throws Exception
     */
    private function _detail_book() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }

        $book = $this->books_model->get_book_by_id($id);
        
        include 'view/book_details.php';
    }
    
    /**
     * Use this function for display of error message
     * 
     * @param array $header - required. header of the message
     * @param array $message - required. message to be displayed
     */
    public function showError($header, $message) {
        include 'view/error.php';
    }
}
?>