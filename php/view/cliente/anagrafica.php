<fieldset>
    <p>
    <h2>Dati personali</h2>
		<ul>
		    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
			<li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
		</ul>
	</h2>
	</p>
	
	<p>
	<h3>Indirizzo</h3>
			<form method="post" action="cliente/anagrafica">	
			<input type="hidden" name="cmd" value="indirizzo"/>
			<p>
				<label for="via">Via o Piazza:</label>
				<input type="text" name="via" id="via" value="<?= $user->getVia() ?>"/>		
			</p>
			<br>
			<p>
			<label for="civico">Numero Civico</label>
			<input type="text" name="civico" id="civico" value="<?= $user->getNumeroCivico() ?>"/>
			</p>
			<br>
			<p>
				<label for="citta">Citt&agrave;</label>
				<input type="text" name="citta" id="citta" value="<?= $user->getCitta() ?>"/>
			</p>
			<br>
			<p>
				<input type="submit" value="Salva" style ="margin-left: 150px;" class="formbutton" />
			</p>
		</form>
	</p>
			
			<h3>Contatti</h3>
			<p>
				<form method="post" action="cliente/anagrafica">
				<input type="hidden" name="cmd" value="email"/>
			</p>
			<p>
				<label for="email">Email:</label>
				<input type="text" name="email" id="email"value="<?= $user->getEmail() ?>"/>
			</p>
			<br>
			<p>
				<input type="submit" value="Salva" style ="margin-left: 150px;" class="formbutton"/>
			<p>
				</form>
			</p>

			
			<h3>Password</h3>
			
				<form method="post" action="cliente/anagrafica">
				<input type="hidden" name="cmd" value="password"/>
				<p>
					<label for="pass1">Nuova Password:</label>
					<input type="password" name="pass1" id="pass1"/>
				</p>
				<br>
				<p>
					<label for="pass2">Conferma:</label>
					<input type="password" name="pass2" id="pass2"/>
				</p>
				<br>
				<p>
					<input type="submit" value="Cambia" style ="margin-left: 150px;" class="formbutton"/>
				</p>
			</form>
			
</fieldset>
