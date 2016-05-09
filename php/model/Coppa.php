<?php

/* Classe Coppa */
class Coppa {

    /* Categoria della competizione
     * @var categoria */
    private $categoria;

    /* Anno di vincita della competizione
     * @var int */
    private $anno;

    /* Costruttore */
    public function __costruct() {
        
    }

    /* id unico per la coppa
     * @return int */
    public function getId() {
        return $this->id;
    }

    /*Imposta un id unico per la coppa
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

    public function setAnno($anno) {
        $intVal = filter_var($anno, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            if ($intVal > 1900 && $intVal <= date("Y")) {
                $this->anno = $intVal;
                return true;
            }
        }
        return false;
    }

    public function getAnno() {
        return $this->anno;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getCategoria() {
        return $this->categoria;
    }

}

?>
