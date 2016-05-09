<?php
include_once 'Db.php';
include_once 'Coppa.php';
include_once 'CategoriaFactory.php';

class CoppaFactory {

    private static $singleton;
    private function __constructor() {
        
    }
	/*Restituisce un singleton per creare la coppa
	* @return \VeicoloFactory*/
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CoppaFactory();
        }

        return self::$singleton;
    }

	/*Restituisce le coppe presenti in memoria
	* @return array|\Coppe*/
    public function &getCoppe() {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCoppe] impossibile inizializzare il database");
            return array();
        }

        $query = "SELECT * from coppe";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCoppe] impossibile" . " inizializzare il prepared statement");
            $mysqli->close();
            return array();
        }

        $toRet = self::inizializzaListaCoppe($stmt);
        $mysqli->close();
        return $toRet;
    }

	/*Riempie una lista di coppe con una query variabile
	* @param mysqli_stmt $stmt
	* @return array|\Coppe*/
    private function &inizializzaListaCoppe(mysqli_stmt $stmt) {
        $veicoli = array();

        if (!$stmt->execute()) {
            error_log("[inizializzaListaCoppa] impossibile" . " eseguire lo statement");
            return $coppe;
        }

        $id = 0;
        $idcategoria = 0;
        $anno = 0;

        if (!$stmt->bind_result($id, $idcategoria, $anno)) {
            error_log("[inizializzaListaCoppa] impossibile" . " effettuare il binding in output");
            return array();
        }
        while ($stmt->fetch()) {
            $coppa = new Coppa();
            $coppa->setId($id);
            $coppa->setCategoria(CategoriaFactory::instance()->getCategoriaPerId($idcategoria));
            $coppa->setAnno($anno);
            $coppe[] = $coppa;
        }
        return $coppe;
    }

    public function creaCoppaDaArray($row) {
        $coppa = new Coppa();
        $coppa->setId($row['coppe_id']);
        $coppa->setCategoria(CategoriaFactory::instance()->getCategoriaPerId($row['coppe_idcategoria']));
        $coppa->setAnno($row['coppe_anno']);
        return $coppa;
    }
    
	/*Salva la coppa nel DB
	* @param Coppa $coppa
	* @return true se è stato salvato*/
    public function nuovo($coppa) {
        $query = "insert into coppe (idcategoria, anno) values (?, ?)";

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[nuovo] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();

        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[nuovo] impossibile" . " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ii', $coppa->getCategoria()->getId(), $coppa->getAnno())){
        error_log("[nuovo] impossibile" . " effettuare il binding in input");
        $mysqli->close();
        return 0;
        }

        if (!$stmt->execute()) {
            error_log("[nuovo] impossibile" . " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
	/*Cancella la coppa con un id specifico
	* @param int $id
	* @return true se è stato cancellato*/
    public function cancellaPerId($id) {
        $query = "delete from coppe where id = ?";

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cancellaPerId] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();

        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cancellaPerId] impossibile" . " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('i', $id)){
        error_log("[cancellaPerId] impossibile" . " effettuare il binding in input");
        $mysqli->close();
        return 0;
        }

        if (!$stmt->execute()) {
            error_log("[cancellaPerId] impossibile" . " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
}
?>
