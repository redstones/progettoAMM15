<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'elencoCoppa':
        include_once 'elencoCoppa.php';
        break;
        
        
        ?>
<?php default: ?>
<fieldset>
<h2>Benvenuto, <?= $user->getNome() ?></h2>
	<p>Scegli in che sezione andare:</p>
	<ul class="blocklist"> 
		<li><a href="cliente/anagrafica">I tuoi dati di registrazione</a></li>
		<br><li><a href="cliente/coppa">Palmares AC Milan</a></li>
	</ul>
</fieldset>
<?php
        break;
}
?>
