<?php
	if (!empty($data)) {
	?>


<div class="pp-row zero_margin">
<div class="pp-col valign-wrapper ps12">
<?php
	foreach ($data as $key => $value) {
			echo (!empty($value)) ? "<a class='pp-breadcrumbs font-roboto valign-wrapper ' href='$value'>" : "<span class='pp-breadcrumbs valign-wrapper '>";
		?>

<?php echo $key; ?>
<?php
	echo (!empty($value)) ? "</a>" : "</span>";
		}
	?>
	</div>
</div>
<?php
	}

?>