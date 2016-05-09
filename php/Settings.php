<?php
/** Classe che contiene una lista di variabili di configurazione*/
class Settings {
	// variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'leporiMassimilia';
    public static $db_password = 'elefante1888';
    public static $db_name='amm15_leporiMassimilia';
    
    private static $appPath;

/* Restituisce il path relativo nel server corrente dell'applicazione
*  Lo uso perche' la mia configurazione locale e' diversa da quella pubblica. 
*  Gestisco il problema in questo script*/
    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // restituisce il server corrente
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/progettoAMM/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/leporiMassimilia/';
                    break;

                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        return self::$appPath;
    }

}

?>
