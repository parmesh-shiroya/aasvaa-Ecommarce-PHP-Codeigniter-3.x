<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tiny_png extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('crons/m_crons', 'model');
	}
	public function index() {
		// require_once "autoload.php";
		require_once "includes/vendor/lib/Tinify/Exception.php";
		require_once "includes/vendor/lib/Tinify/ResultMeta.php";
		require_once "includes/vendor/lib/Tinify/Result.php";
		require_once "includes/vendor/lib/Tinify/Source.php";
		require_once "includes/vendor/lib/Tinify/Client.php";
		require_once "includes/vendor/lib/Tinify.php";
		\Tinify\setKey("jpbA8wxgTL0TGWIeJ5DkqnTqzxkT1iQG");
		// $source = \Tinify\fromFile("uploads/banner/5banner/800_0/dfcabeed876e47219058ffa8a75318297a385086d8b462629b86b2a0997193ed.jpg");
		// $source->toFile("optimized.jpg");
		echo $compressionsThisMonth = \Tinify\compressionCount();
	}
}