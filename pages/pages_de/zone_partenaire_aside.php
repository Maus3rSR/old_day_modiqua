<ul class="menu_aside">
	<?php if(is_connected() && !is_admin()){ ?>
	<li><a href="../include/logout.php">Deconnection</a></li>
	<?php }else{ ?>
	<li><a href="../index.php?page=acces_membre&categ=login">Connection</a></li>
	<?php } ?>
</ul>