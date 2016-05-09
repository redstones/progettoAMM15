<?php
/*Classe Categoria di coppe */
class Categoria {
	/* Identificatore unico della coppa
	* @var int */
    private $id;
    
	/*Nome della Competizione
	* @var Competizione */
    private $costruttore;

    /*Nome della categoria di coppe
	* @var String*/
    private $nome;

    /*Restituisce identificatore unico per la classe
	* @return int */
    public function getId() {
        return $this->id;
    }

    /*Imposta un identificatore unico per la classe
	* @param int $id
	* @return boolean true se il valore e' stato aggiornato correttamente,
	* false altrimenti */
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCompetizione($competizione) {
        $this->competizione = $competizione;
        return true;
    }

    public function getCompetizione() {
        return $this->competizione;
    }

}

?>
