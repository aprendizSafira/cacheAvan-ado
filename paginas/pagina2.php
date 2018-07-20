<html>
<head>
	<title>Página de Cache</title>
</head>
<body>
	<?php
	try {
		$pdo = new PDO("mysql:dbname=test;host=localhost", "root", "");

		$sql = "SELECT * FROM artigos ORDER BY RAND()";
		$sql = $pdo->query($sql);
		foreach($sql->fetchAll() as $noticias) {
			$cor = rand(0, 999999);
			$len = rand(0, 400);
			?>
			<div style="width:300px;height:auto;float:left;margin:20px;background-color:#<?php echo $cor; ?>;padding:10px;">
				<strong><?php echo utf8_encode($noticias['titulo']); ?></strong><br/>
				<?php echo substr($noticias['noticia'], 0, $len); ?>
			</div>
			<?php
		}
	} catch(PDOException $e) {
		print_r($e->getMessage());
	}
	?>
</body>
</html>