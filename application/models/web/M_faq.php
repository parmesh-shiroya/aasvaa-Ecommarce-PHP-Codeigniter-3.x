<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_faq extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function get_questions() {
		$result = $this->db->get('faq_question');
		return $result->result();
	}
}