<?php
    include_once ('information.php');
    include_once ('menu.php');


?>
<div id="content" class="content">
    <span class="navname">Profil módosítása</span><br>
    <div class="form_content">
        <form action="home.php" method="post" autocomplete="off">
			<div>
				<label for="lastname">Vezetéknév:</label><br>
				<input type="text" id="lastname" name="lastname" value="<?= $userinfo['lastname'] ?>" required placeholder="Vezetéknév"><br>
				<label for="firstname">Keresztnév:</label><br>
				<input type="text" id="firstname" name="firstname" value="<?= $userinfo['firstname'] ?>" required placeholder="Keresztnév"><br>
				<label for="address" >Lakhely:</label><br>
				<input type="text" id="address" name="address" value="<?= $userinfo['address'] ?>" required placeholder="Lakhely"><br>
				<label for="password">Jelszó:</label><br>
				<input type="password" id="password" name="password" placeholder="Jelszó"><br>
				<label for="passwordc">Jelszó megerősítése:</label><br>
				<input type="password" id="passwordc" name="passwordc" placeholder="Jelsző megerősítése"><br>
				<label for="email">E-mail:</label><br>
				<input type="email" id="email" name="email" value="<?= $userinfo['email'] ?>" required placeholder="E-mail">
			</div>
            <button id="button" value="modifyDatas" name="modifyDatas" class="button">Módosítás</button>
        </form>
    </div>
</div>
<script>
	$(':root').css("--changeImage", "url('../svg/group_black_24dp.svg')");
</script>
<script type="text/javascript" src="js/editDataTable.js"></script>
<script type="text/javascript" src="js/Modal.js"></script>
<?php
    include_once ('bottom.php');
?>
