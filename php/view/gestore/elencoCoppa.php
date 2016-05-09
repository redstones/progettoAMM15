
	<h2>Elenco Coppe</h2>
	<table cellspacing="0">
	<tbody>
		<tr>
		    <th>Competizione</th>
		    <th>Categoria </th>
		    <th>Anno Vittoria</th>
		    <th>Cancella</th>
		</tr>
    <?   
    foreach ($coppe as $coppa) {
    ?>
        <tr>
            <td><?= $coppa->getCategoria()->getCompetizione()->getNome() ?></td>
            <td><?= $coppa->getCategoria()->getNome() ?></td>
            <td><?= $coppa->getAnno() ?></td>
            <td><a href="gestore/coppa?cmd=cancella_coppa&coppa=<?= $coppa->getId()?>" title="Elimina la coppa">
			<img src="../images/delete.png" alt="Elimina"></a>
        </tr>
    <? } ?>
    <tbody>
	</table>
    

