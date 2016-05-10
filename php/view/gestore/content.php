<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'elencoCoppa':
        include_once 'elencoCoppa.php';
        break;
    
    case 'crea_coppa':
        include_once 'crea_coppa.php';
        break;
        
    case 'new_coppa':
        include_once 'crea_coppa.php';
        break;
?>

<?php default: ?>
<fieldset>
<h2>Benvenuto, <?= $user->getNome() ?></h2>
		<p>Scegli in che sezione andare:</p>
		<ul class="blocklist"> 
			<li><a href="gestore/anagrafica">I tuoi dati di registrazione</a></li>
			<br><li><a href="gestore/coppa">Visualizza/elimina coppe dal Palmares AC Milan</a></li> 
			<br><li><a href="gestore/new_coppa">Inserisci una nuova Coppa al Palmares AC Milan</a></li>
		</ul>
</fieldset>
<?php
        break;
}
?>
