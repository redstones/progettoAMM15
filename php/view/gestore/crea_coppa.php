<fieldset>
    <h3>Inserisci Coppa al Palmares</h3>
    <form method="post" action="gestore/crea_coppa">
    <input type="hidden" name="cmd" value="coppa_nuovo"/>
        <p>
		    <label for="categoria">Categoria</label>
		    <select name="categoria" id="categoria">
		        <?php foreach ($categorie as $categoria) { ?>
					<option value="<?= $categoria->getId() ?>" >
					<?= $categoria->getCompetizione()->getNome() . " - " . $categoria->getNome() ?></option>
				<?php } ?>
			</select>
		</p>
	<br>
	<p>
		<label for="anno">Anno</label>
		<input type="anno" name="anno" id="anno"/>
	</p>
	<br>
	<p>
		<input type="submit" value="Inserisci Coppa" style="margin-left: 150px;" class="formbutton">
		<input type="submit" value="Annulla" style="margin-left: 150px;" class="formbutton">
	</p>
	</form>
</fieldset>
