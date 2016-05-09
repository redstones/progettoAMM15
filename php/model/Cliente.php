<?php

include_once 'User.php';

/*Classe che rappresenta il cliente*/
class Cliente extends User {

	/*Costruttore*/
    public function __construct() {
        // call to costruttore superclass
        parent::__construct();
        $this->setRuolo(User::Cliente);        
    }
}

?>


