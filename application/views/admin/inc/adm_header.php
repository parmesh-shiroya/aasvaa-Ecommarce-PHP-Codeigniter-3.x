<!DOCTYPE html>
<html>
<head>
    <title>Aasvaa</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>

    <?php
$dirjs = glob('assetes/js/*.js');
foreach ($dirjs as $key) {
	echo '<script type="text/javascript" src="' . base_url() . $key . '"></script>';
}
$dircss = glob('assetes/css/*.css');
foreach ($dircss as $key) {
	echo '<link rel="stylesheet" href="' . base_url() . $key . '" />';
}
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- add assete -->
<link rel="stylesheet" href="<?php echo base_url("assetes/otherassets/css/admin1.min.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("assetes/otherassets/js/admin1.js"); ?>"></script>
</head>
    <body>

        <div>