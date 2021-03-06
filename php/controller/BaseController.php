<?php

include_once basename(__DIR__) . '/../view/ViewDescriptor.php';
include_once basename(__DIR__) . '/../model/User.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';
include_once 'ClienteController.php';

/*Controller che gestisce gli utenti non autenticati*/
class BaseController {

    const user = 'user';
    const role = 'role';

	/*Costruttore*/
    public function __construct() {
        
    }
	/*Metodo per gestire l'input dell'utente. Le sottoclassi lo sovrascrivono
	* @param type $request la richiesta da gestire */
    public function handleInput(&$request) {
        /* descrittore della vista*/
        $vd = new ViewDescriptor();

        // imposto la pagina
        $vd->setPagina($request['page']);

        /*Gestione dei comandi
        * tutte le variabili che vengono create senza essere utilizzate
        * direttamente in questo switch, sono quelle che vengono poi lette
        * dalla vista, ed utilizzano le classi del modello */ 
		if (isset($request["cmd"])) {
            
            // abbiamo ricevuto un comando
            switch ($request["cmd"]) {            	
                case 'login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);
                    
                    /*Variabile utilizzata dalla vista*/
                    if ($this->loggedIn())
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
                default : $this->showLoginPage();
            }
        } else {
            if ($this->loggedIn()) {
                //utente autenticato, variabile poi utilizzata dalla vista
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                $this->showHomeUtente($vd);
            } else {
                // utente non autenticato
                $this->showLoginPage($vd);
            }
        }

        // richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }
	/*Verifica se l'utente sia correttamente autenticato
	* @return boolean true se l'utente era gia' autenticato, false altrimenti */
    protected function loggedIn() {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }
	/*Imposta la vista master.php per visualizzare la pagina di gestione del cliente
	* @param ViewDescriptor $vd il descrittore della vista */
    protected function showHomeCliente($vd) {
        // mostro la home dei clienti

        $vd->setTitolo("Palmares AC Milan - Cliente ");
        $vd->setLogoFile(basename(__DIR__) . '/../view/cliente/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/cliente/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/cliente/content.php');
    }
	/*Imposta la vista master.php per visualizzare la pagina di login
	* @param ViewDescriptor $vd il descrittore della vista */
    protected function showLoginPage($vd) {
        // mostro la pagina di login
        $vd->setTitolo("Palmares AC Milan - Login");
        $vd->setLogoFile(basename(__DIR__) . '/../view/login/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/login/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/login/content.php');
    }
	/*Imposta la vista master.php per visualizzare la pagina di gestione del dipendente
	* @param ViewDescriptor $vd il descrittore della vista*/
    function showHomeGestore($vd) {
        // mostro la home dei dipendenti
        $vd->setTitolo("Palmares AC Milan - Gestore");
        $vd->setLogoFile(basename(__DIR__) . '/../view/gestore/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/gestore/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/gestore/content.php');
    }
    
	/*Seleziona quale pagina mostrare in base al ruolo dell'utente corrente
	* @param ViewDescriptor $vd il descrittore della vista*/
    protected function showHomeUtente($vd) {
        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
        switch ($user->getRuolo()) {
            case User::Cliente:
                $this->showHomeCliente($vd);
                break;

            case User::Gestore:
                $this->showHomeGestore($vd);
                break;
        }
    }
	/*Procedura di autenticazione
	* @param ViewDescriptor $vd descrittore della vista
	* @param string $username lo username specificato
	* @param string $password la password specificata*/
    protected function login($vd, $username, $password) {
        // carichiamo i dati dell'utente

        $user = UserFactory::instance()->caricaUtente($username, $password);
        if (isset($user) && $user->esiste()) {
            // utente autenticato
            $_SESSION[self::user] = $user->getId();
            $_SESSION[self::role] = $user->getRuolo();
            $this->showHomeUtente($vd);
        } else {
            $vd->setMessaggioErrore("Dati errati oppure utente non presente");
            $this->showLoginPage($vd);
        }
    }
	/*Procedura di logout dal sistema
	* @param type $vd il descrittore della pagina */
    function logout($vd) {
        // reset array $_SESSION
        $_SESSION = array();
        // termino la validita' del cookie di sessione
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            // imposto il termine di validita' al mese scorso
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        // distruggo il file di sessione
        session_destroy();
        $this->showLoginPage($vd);
    }

	/*Crea un messaggio di feedback per l'utente
	* @param array $msg lista di messaggi di errore
	* @param ViewDescriptor $vd il descrittore della pagina
	* @param string $okMsg il messaggio da mostrare nel caso non ci siano errori*/
    protected function creaFeedbackUtente(&$msg, $vd, $okMsg) {
        if (count($msg) > 0) {
            // errore nell'array,
            $error = "Si sono verificati i seguenti errori \n<ul>\n";
            foreach ($msg as $m) {
                $error = $error . $m . "\n";
            }
            // imposto il messaggio di errore
            $vd->setMessaggioErrore($error);
        } else {
            // non ci sono errori, messaggio di conferma
            $vd->setMessaggioConferma($okMsg);
        }
    }
	/*Aggiorno l'indirizzo di un utente (comune a Cliente e Gestore)
	* @param User $user l'utente da aggiornare
	* @param array $request la richiesta http da gestire
	* @param array $msg riferimento ad un array da riempire con eventuali
	* messaggi d'errore*/
     protected function aggiornaIndirizzo($user, &$request, &$msg) {
        if (isset($request['via'])) {
            if (!$user->setVia($request['via'])) {
                $msg[] = '<li>La via specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['civico'])) {
            if (!$user->setNumeroCivico($request['civico'])) {
                $msg[] = '<li>Il formato del numero civico non &egrave; corretto</li>';
            }
        }
        if (isset($request['citta'])) {
            if (!$user->setCitta($request['citta'])) {
                $msg[] = '<li>La citt&agrave; specificata non &egrave; corretta</li>';
            }
        }

        // salvataggio dati in caso no errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }
	/*Aggiorno l'indirizzo email di un utente (comune a Cliente e Gestore)
	* @param User $user l'utente da aggiornare
	* @param array $request la richiesta http da gestire
	* @param array $msg riferimento ad un array da riempire con eventuali
	* messaggi d'errore*/
    function aggiornaEmail($user, &$request, &$msg) {
        if (isset($request['email'])) {
            if (!$user->setEmail($request['email'])) {
                $msg[] = '<li>L\'indirizzo email specificato non &egrave; corretto</li>';
            }
        }

        // salviamo i dati se non ci sono stati errori
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }
	/*Aggiorno la password di un utente (comune a Cliente e Gestore)
	* @param User $user l'utente da aggiornare
	* @param array $request la richiesta http da gestire
	* @param array $msg riferimento ad un array da riempire con eventuali
	* messaggi d'errore*/
    protected function aggiornaPassword($user, &$request, &$msg) {
        if (isset($request['pass1']) && isset($request['pass2'])) {
            if ($request['pass1'] == $request['pass2']) {
                if (!$user->setPassword($request['pass1'])) {
                    $msg[] = '<li>Il formato della password non &egrave; corretto</li>';
                }
            } else {
                $msg[] = '<li>Errore! Le password non coincidono</li>';
            }
        }
        /* salvo i dati quando non ci sono errori*/
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio della password non riuscito!</li>';
            }
        }
    }
}

?>
