
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_other', 'model');
	}
	public function index() {
		$data['questions'] = $this->model->get_faq_questions();
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/add_faq', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}
	public function add() {
		if ($this->pp_login_varified->admin_varified()) {
			$data = "";
			if (isset($_POST['add_faq_admin']) && isset($_POST['faq_question']) && isset($_POST['faq_answer'])) {
				$result = $this->model->add_faq_question(array('que' => $this->input->post('faq_question'), 'ans' => $this->input->post('faq_answer')));
				if ($result) {
					$data['status'] = "Faq Add Successfully.";
				} else {
					$data['status'] = "Something Wrong, Please Try Again.";
				}
			}
			$data['questions'] = $this->model->get_faq_questions();
			$this->load->view('admin/inc/adm_header');
			$this->load->view('admin/inc/adm_nav_start');
			$this->load->view('admin/other/add_faq', $data);
			$this->load->view('admin/inc/adm_nav_end');
			$this->load->view('admin/inc/adm_footer');
		}
	}

	public function delete_question() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['que_id'])) {
				$this->output->set_content_type('application_json');
				$result = $this->model->delete_faq($_POST['que_id']);
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function update_question() {
		if ($this->pp_login_varified->admin_varified()) {
			$data = "";
			if (isset($_POST['update_faq_admin']) && isset($_POST['faq_question']) && isset($_POST['faq_id']) && isset($_POST['faq_answer'])) {
				$result = $this->model->update_faq($_POST['faq_id'], array('que' => $this->input->post('faq_question'), 'ans' => $this->input->post('faq_answer')));
				if ($result) {
					$data['status'] = "Faq Update Successfully.";
				} else {
					$data['status'] = "Something Wrong, Please Try Again.";
				}
			}
			$data['questions'] = $this->model->get_faq_questions();
			$this->load->view('admin/inc/adm_header');
			$this->load->view('admin/inc/adm_nav_start');
			$this->load->view('admin/other/add_faq', $data);
			$this->load->view('admin/inc/adm_nav_end');
			$this->load->view('admin/inc/adm_footer');
		}
	}

	public function get_question_single() {
		if (isset($_POST['faq_id'])) {
			$this->output->set_content_type('application_json');
			$result = $this->model->get_single_faq($_POST['faq_id']);
			$this->output->set_output(json_encode($result));
		}
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */