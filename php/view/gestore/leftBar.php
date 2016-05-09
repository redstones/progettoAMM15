<h3>Gestore</h3>
	<ul>
		<li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="gestore/home">Home</a></li>
		<li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="gestore/anagrafica">I tuoi dati</a></li>
		<li class="<?= $vd->getSottoPagina() == 'coppa' ? 'current_page_item' : '' ?>"><a href="gestore/coppa">Palmares Ac Milan</a></li>
		<li class="<?= $vd->getSottoPagina() == 'coppa' ? 'current_page_item' : '' ?>"><a href="gestore/new_coppa">Inserisci nuova coppa</a></li>
	</ul>

