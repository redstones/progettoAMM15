<h2>Elenco Coppe</h2>
<table>
    <tr>
        <th>Competizione</th>
        <th>Categoria </th>
        <th>Anno Vittoria</th>
    </tr>
    <?
    foreach ($coppe as $coppa) {
        ?>
<tr>
            <td><?= $coppa->getCategoria()->getCompetizione()->getNome() ?></td>
            <td><?= $coppa->getCategoria()->getNome() ?></td>
            <td><?= $coppa->getAnno() ?></td>
</tr>
<? } ?>
</table>
