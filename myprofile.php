<?php
	include("header.php");

	$saberr = mysql_query("SELECT * FROM users WHERE email='$login_cookie'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $saber['email'];

	$pubs = mysql_query("SELECT * FROM pubs WHERE user='$email' ORDER BY id desc");

	if (isset($_POST['settings'])){
		header("Location: settings.php");
	}
?>

<html>
	<header>
		<style type="text/css">
			h2{text-align: center;padding-top: 20px; color: #FFF;}
			img#profile{width: 120px; height: 120px; display: block; margin: auto;margin-top: 30px; border-width: 5px; border: solid; border-color: #007fff; background-color: #007fff; border-radius:5px; margin-bottom: -35px;} 
			div#menu{width: 300px; height: 120px;display: block; margin: auto; border: none; border-radius: 5px; background-color: #007fff; text-align: center;}
			div#menu input{height: 25px; border: none; border-radius: 3px; background-color: #FFF; cursor: pointer; margin-top: -20px;}
			div#menu input[name="settings"]{margin-right: 40px;}
			div#menu input:hover{height: 25px; border: none; border-radius: 3px; background-color: transparent; cursor: pointer; color: #FFF;}
			div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
			div.pub a{color: #666; text-decoration: none;}
			div.pub a:hover{color: #111; text-decoration: none;}
			div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
			div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
			div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}

		</style>
	</header>

	<body>
		<?php 
			if($saber["img"]==""){
				echo '<a href="profilepic.php" style="width:120px; display: block; margin: auto;"><img src="img/user.png" id ="profile"></a>';
			}else{
				echo '<a href="profilepic.php" style="width:120px; display: block; margin: auto;"><img src="upload/'.$saber["img"].'" id ="profile"></a>';
			}
		?>

		<div id="menu">
			<form method="POST">
				<h2><?php echo $saber['apelido']?></h2><br />
				<input type="submit" value="Alterar info" name="settings"><input type="submit" name="amigos" value="Ver amigos">
			</form>	
		</div>

		<?php
			while ($pub=mysql_fetch_assoc($pubs)) {
				$email = $pub['user'];
				$saberr = mysql_query("SELECT * FROM users WHERE email='$email'");
				$saber = mysql_fetch_assoc($saberr);
				$nome = $saber['apelido'];
				$id = $pub['id'];

				if($pub['imagem'] == ""){
					echo '<div class="pub" id="'.$id.'">
						<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
						<span>'.$pub['texto'].'</span> <br />
					</div>';
				} else{
					echo'<div class="pub" id="'.$id.'">
						<p><a href="profile.php?id='.$saber['id'].'">'.$nome.'</a> - '.$pub["data"].'</p>
						<span>'.$pub['texto'].'</span>
						<img src = "upload/'.$pub["imagem"].'" />
					</div>';
				}
			}
		?>
		<div id="footer"><p>&copy; Write It, 2017 - Todos os direitos Reservados</p></div>
	</body>
</html>