<html>
<head>
	<title>Página de Cache</title>
</head>
<body>
	<?php
	try {
		$pdo = new PDO("mysql:dbname=test;host=localhost", "root", "");

		$sql = "SELECT * FROM posts ORDER BY RAND()";
		$sql = $pdo->query($sql);
		foreach($sql->fetchAll() as $noticias) {
			$cor = rand(0, 999999);
			$len = rand(0, 100);
			?>
			<div style="width:250px;float:left;margin:20px;background-color:#<?php echo $cor; ?>;padding:10px;">
				<strong><?php echo utf8_encode($noticias['titulo']); ?></strong><br/><br/>
				<?php echo substr($noticias['noticia'], 0, $len); ?>
			</div>
			<?php
		}
	} catch(PDOException $e) {
		echo "ERRO NO BANCO: ".$e->getMessage();
	}
	?>
</body>
</html>