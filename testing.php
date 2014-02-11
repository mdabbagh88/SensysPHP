<?php include "header.php"; ?>

<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="row">
<div class="col-lg-6">
<select multiple class="form-control" name="ext[]">
	<option value="jpeg">JPEG</option>
	<option value="png">PNG</option>
</select>
<button type="submit" class="btn btn-primary">Hajar</button>
</div>
</div>
</form>
<?php

if(!isset($_REQUEST['ext'])){

}else
{
	$isi = $_REQUEST['ext'];
	echo "#(";
	foreach ($isi as $key) {
		echo $key;
	}
	echo "#)";
}

?>

<?php include "footer.php"; ?>