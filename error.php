<?php
if (isset($_SESSION["errores"])){
?>	
<div id="contab-middle-two-er">
	<div class="contab-corner-tr-er">&nbsp;</div>
	<div class="contab-corner-tl-er">&nbsp;</div>
	<div id="contab-content-er">


<?php
foreach ($_SESSION['errores'] as $error => $mensaje) {
echo "<p>$mensaje</p>";
}
?>
	</div>
	<div class="contab-corner-br-er">&nbsp;</div>
	<div class="contab-corner-bl-er">&nbsp;</div>
</div>
<?php
session_unregister("errores");
};
?>