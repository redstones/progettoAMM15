<?php

include_once 'Competizione.php';
include_once 'Db.php';

class CompetizioneFactory {

    private static $singleton;

    private function __constructor() {
        
    }

	/* Restituisce un singleton per creare la Competizione
	* @return CompetizioneFactory */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CompetizioneFactory();
        }
        return self::$singleton;
    }

    public function &getCompetizionePerId($id) {
        $competizione = new Competizione();
        $query = "select * from competizioni where id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCompetizionePerId] impossibile inizializzare il database");
            $mysqli->close();
            return $competizione;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCompetizionePerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $competizione;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[getCompetizionePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $competizione;
        }

        if (!$stmt->execute()) {
            error_log("[getCompetizionePerId] impossibile" .
                    " eseguire lo statement");
            return $competizione;
        }

        $id = 0;
        $nome = "";

        if (!$stmt->bind_result($id, $nome)) {
            error_log("[getCompetizionePerId] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        while ($stmt->fetch()) {
            $competizione->setId($id);
            $competizione->setNome($nome);
        }
        

        $mysqli->close();
        return $competizione;
    }

	/* Restituisce la lista di competizioni
	* @return array|\Costruttore */
    public function &getCompetizioni() {

        $competizioni = array();
        $query = "select * from competizioni";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCompetizioni] impossibile inizializzare il database");
            $mysqli->close();
            return $competizioni;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getCompetizioni] impossibile eseguire la query");
            $mysqli->close();
            return $competizioni;
        }

        while ($row = $result->fetch_array()) {
            $competizioni[] = self::getCompetizioni($row);
        }

        $mysqli->close();
        return $competizioni;
    }

	/* Crea un oggetto di tipo Costruttore a partire da una riga del DB
	* @param type $row
	* @return \Costruttore */
    private function getCompetizione($row) {
        $competizione = new Competizione();
        $competizione->setId($row['id']);
        $competizione->setNome($row['nomecompetizione']);
        return $competizione;
    }
}
?>
