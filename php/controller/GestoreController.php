<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';
include_once basename(__DIR__) . '/../model/Coppa.php';
include_once basename(__DIR__) . '/../model/CoppaFactory.php';

/* Controller gestore */
class GestoreController extends BaseController {

    const elenco = 'elenco';

    public function __construct() {
        parent::__construct();
    }

    /* Metodo per gestire l'input dell'utente.
     * @param type $request la richiesta da gestire */
    public function handleInput(&$request) {

        // creo il descrittore della vista
        $vd = new ViewDescriptor();

        // imposto la pagina
        $vd->setPagina($request['page']);

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
        } else {
            // utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId($_SESSION[BaseController::user], $_SESSION[BaseController::role]);

            /* Verifico quale sia la sottopagina della categoria
            *  dipendente da servire ed imposto il descrittore
            *  della vista per caricare i "pezzi" delle pagine corrette.
            *  Tutte le variabili che vengono create senza essere utilizzate
            *  direttamente in questo switch, sono quelle che vengono poi lette
            *  dalla vista, ed utilizzano le classi del modello */ 
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // modifica dei dati anagrafici
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;

                    //visualizza coppa
                    case 'coppa':
                        $coppe = CoppaFactory::instance()->getCoppe();
                        $vd->setSottoPagina('elencoCoppa');
                        break;
                    
                    //nuova coppa
                    case 'new_coppa':
                        $categorie = CategoriaFactory::instance()->getCategorie();
                        $vd->setSottoPagina('crea_coppa');
                        break;

                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }
            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    case 'logout':
                        $this->logout($vd);
                        break;

                    // cambio email
                    case 'email':
                        // in questo array inserisco i messaggi di cio' che non viene validato
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Email aggiornata");
                        $this->showHomeUtente($vd);
                        break;

                    // aggiornamento indirizzo
                    case 'indirizzo':

                        // in questo array inserisco i messaggi di cio' che non viene validato
                        $msg = array();               
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
                        $this->showHomeUtente($vd);
                        break;

                    // modifica della password
                    case 'password':
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeUtente($vd);
                        break;


                    // Operazione abortita
                    case 'coppe_annulla': 
                        $vd->setSottoPagina('elencoCoppa');
                        $this->showHomeUtente($vd);
                        break;


                    //form per la creazione di una nuova coppa
                    case 'new_coppa':
                        $categorie = CategoriaFactory::instance()->getCategorie();
                        $vd->setSottoPagina('crea_coppa');
                        $this->showHomeUtente($vd);
                        break;

                    // creazione di una nuova coppa
                    case 'coppa_nuovo':
                        $vd->setSottoPagina('elencoCoppa');
                        $msg = array();
                        $nuovo = new Coppa();
                        $nuovo->setId(-1);
                        $nuovo->setCategoria(CategoriaFactory::instance()->getCategoriaPerId($request['categoria']));

                        if ($request['anno'] != "") {
                            $nuovo->setAnno($request['anno']);
                        } else {
                            $msg[] = '<li> Inserire un anno valido </li>';
                        }
                        
                        if (count($msg) == 0) {
                            $vd->setSottoPagina('elencoCoppa');
                            if (CoppaFactory::instance()->nuovo($nuovo) != 1) {
                                $msg[] = '<li> Impossibile inserire un nuovo trofeo </li>';
                            }
                        }

                        $this->creaFeedbackUtente($msg, $vd, "Coppa Inserita");

                        $coppe = CoppaFactory::instance()->getCoppe();
                        $this->showHomeUtente($vd);
                        break;


                    // cancella una coppa
                    case 'cancella_coppa':
                        if (isset($request['coppa'])) {
                            $intVal = filter_var($request['coppa'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($intVal)) {

                                if (CoppaFactory::instance()->cancellaPerId($intVal) != 1) {
                                    $msg[] = '<li> Impossibile cancellare la coppa </li>';
                                }


                                $this->creaFeedbackUtente($msg, $vd, "Trofeo eliminato");
                            }
                        }
                        $coppe = CoppaFactory::instance()->getCoppe();
                        $this->showHomeUtente($vd);
                        break;
                                         
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                /*Visualizza la vista nessun comando*/
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }
        // richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
	}
	
	
}

?>
