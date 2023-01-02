<script>
	$(document).ready(function() {
		<?php
if (!isset($_SESSION['report']) || !isset($_SESSION['report']['ftq'])) {?>
		$.post(base_url+'report/index/ftq', {ftq: 'ftq'}, function(data, textStatus, xhr) {});
		<?php }

if (!isset($_SESSION['report']['stay_time']['timer']) || time() - $_SESSION['report']['stay_time']['timer'] > 60) {
	?>
	$.post(base_url+'report/index/ust', {ust: 'ust'}, function(data, textStatus, xhr) {});
<?php }?>
	});
</script>