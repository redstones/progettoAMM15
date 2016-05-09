<fieldset>
    <h3>Ricerca Coppa per categoria</h3>
    <form method="post" action="gestore/ricerca_coppa">      
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
        
        <button id="trova" type="submit" name="cmd" value="elencoCoppa">Cerca Coppe</button>
    </form>
</div>


</fieldset>
