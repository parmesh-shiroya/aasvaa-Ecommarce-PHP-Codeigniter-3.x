<?php /* <!-- https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction --> */?>
<form method="post" id="submit_form" name="redirect" class="zero_margin" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<!--  -->

<?php

echo "<input type=hidden name=encRequest value=$encrypted_data>";

echo "<input type=hidden name=access_code value='$access_code'>";

?>

</form>



<script>
document.addEventListener("DOMContentLoaded", function(event) {
	document.getElementById("submit_form").submit();
});
</script>