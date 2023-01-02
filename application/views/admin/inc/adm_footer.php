</div>
<footer></footer>
</body>
<?php
	if (isset($javascript)) {
		foreach ($javascript as $key => $value) {
			echo '<script type="text/javascript" src="' . base_url($value) . '"></script>';
		}
	}
	if (isset($css)) {
		foreach ($css as $key => $value) {
			echo '<link rel="stylesheet" href="' . base_url($value) . '" />';
		}

	}
?>
</html>