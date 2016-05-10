<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php';

if (!$vd->isJson()) {
    ?>

<!DOCTYPE html>

<html>

<!--  HEADER -->
	<head>
		<title><?= $vd->getTitolo() ?></title>
			
		<base href="<?= Settings::getApplicationPath() ?>php/"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="../css/styles.css" type="text/css" />
		<?php
            foreach ($vd->getScripts() as $script) {
         	?>
			<script type="text/javascript" src="<?= $script ?>"></script>
			<?php
         }
         ?>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
		
		<script type="text/javascript">
		onload=function(){
		if(!document.getElementById || !document.getElementsByTagName) return;
		ext=document.getElementById("links");
		l=ext.getElementsByTagName("a");
		for(i=0;i<l.length;i++)
		l[i].onclick=function(){window.open(this.href);return(false)};
    }
</script>
		
	</head>
	
	<!--  BODY  -->
	<body>
		<div id="container">
			<header>
				<div class="width" id="title">
					<h1>
						<img href="http://www.acmilan.com" id="pngLogoL" alt="LOGO"/>
						<a>Palmares AC Milan</a>
					</h1>
				</div>
					<nav>
							<?php
		                    $logo = $vd->getLogoFile();
		                    require "$logo";
		                    ?>
					</nav>
			</header>
			
	<!--  SIDEBAR -->
	<div id="body" class="width">
		<aside class="sidebar small-sidebar left-sidebar">
					<h3 id="navigazioneParola">Naviga</h3>
					<?php
                    $left = $vd->getLeftBarFile();
                    require "$left";
                    ?>
                    <h3>Link Esterni</h3>
                   	 <div id="links">
                   	 <ul>
    					<li><a href="http://www.unica.it/">Universit&agrave; di Cagliari</a></li>
    					<li><a href="http://corsi.unica.it/informatica/">Facolt&agrave; di Informatica</a></li>
    					<li><a href="http://www.acmilan.com">AC Milan</a></li>
					</ul>
					</div>					
		</aside>
	
	 <!-- CONTENUTO DEL MASTER -->
	 <article>
		<section id="content" class="two-column with-left-sidebar">
					<?php
                    if ($vd->getMessaggioErrore() != null) {
                        ?>
			<div class="error">
				<p>
				<div>
					<?=
                    $vd->getMessaggioErrore();
                    ?>
				</div>
				</p>
			</div>
			<p>
					<?php
                    }
                    ?>
					<?php
                    if ($vd->getMessaggioConferma() != null) {
                        ?>
            </p>
			<div class="confirm">
				<p>
				<div>
					<?=
		            $vd->getMessaggioConferma();
		            ?>
				</div>
				</p>
			</div>
			<p>
				<?php
                }
                ?>
				<?php
                $content = $vd->getContentFile();
                require "$content";
                ?>
            </p>

			</section>
    </article>
		<div class="clear">
		</div>
		
		
	<!--  FOOTER -->
			<footer>
					
					<p>Progetto Amministrazione di Sistema - Massimiliano Lepori</p>
					<br><a href="http://www.acmilan.com/it/club/palmares">Palmares sito ufficiale AC Milan</a>
					<br><a href="http://validator.w3.org/check?uri=referer">HTML Valid</a>
						<a href="http://jigsaw.w3.org/css-validator/check/refer">CSS Valid</a>
					
			</footer>
		</div>
		</div>
	</body>
</html>
<?php
} else {

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');

    $content = $vd->getContentFile();
    require "$content";
}
?>
