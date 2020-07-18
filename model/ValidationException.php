<?php

/**
 * This class is for Books Controller
 *
 * @author christian
 */

class ValidationException extends Exception {
    
    private $errors = NULL;
    
    public function __construct($errors) {
        parent::__construct("Validation error!");
        $this->errors = $errors;
    }
    
    /**
     * Use this function to error message
     *
     * @return Error Message
     */
    public function getErrors() {
        return $this->errors;
    }
}

?>