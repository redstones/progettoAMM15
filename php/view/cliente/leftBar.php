<h2>Cliente</h2>
<ul class="blocklist">
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : '' ?>"><a href="cliente">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="cliente/anagrafica">I tuoi dati</a></li>
    <li class="<?= $vd->getSottoPagina() == 'coppa' ? 'current_page_item' : '' ?>"><a href="cliente/coppa">Palmares Ac Milan</a></li>
    
</ul>
