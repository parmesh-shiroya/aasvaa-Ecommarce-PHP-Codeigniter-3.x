<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Managecategory extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/product_manager/m_prodman', 'model');
	}
	public function index() {
		$data['sub_cats']  = $this->model->get_datas('sub_cat_mst');
		$data['main_cats'] = $this->model->get_datas('main_cat_mst');
		$data['images']    = $this->model->get_main_cat_imgs();

		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/product_manager/manage_categorys', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}
	public function add_main() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['main_cat_name'])) {
				$this->output->set_content_type('application_json');
				$form_rules = array(
					array(
						'field'  => 'main_cat_name',
						'label'  => 'Category Name',
						'rules'  => 'trim|required|is_unique[main_cat_mst.cat_name]',
						'errors' => array(
							'required'  => 'You must provide a %s.',
							'is_unique' => 'This %s already exists.',
						),
					),
				);
				$this->form_validation->set_rules($form_rules);
				if ($this->form_validation->run() == FALSE) {
					$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
				} else {
					$result = $this->model->add_main_cate(array(
						"cat_name" => ucfirst($this->input->post('main_cat_name')),
					));
					$this->output->set_output(json_encode(['result' => $result]));
				}
			}
		}
	}

	public function add_sub() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['sub_cat_name'])) {

				$this->output->set_content_type('application_json');
				$form_rules = array(
					array(
						'field'  => 'sub_cat_name',
						'label'  => 'Category Name',
						'rules'  => 'trim|required',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
				);
				$this->form_validation->set_rules($form_rules);
				if ($this->form_validation->run() == FALSE) {
					$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
				} else {
					if (empty($this->model->get_sub_category($this->input->post('main_cat_id'), $this->input->post('sub_cat_name')))) {
						$result = $this->model->add_sub_cate(array(
							"cat_name"    => ucfirst($this->input->post('sub_cat_name')),
							"main_cat_id" => $this->input->post('main_cat_id'),
						));
						$this->output->set_output(json_encode(['result' => $result]));
					} else {
						$this->output->set_output(json_encode(['result' => 1]));
					}

				}
			}
		}
	}

	public function main_cats() {
		$data = $this->model->get_all_main_cats();
		$this->output->set_content_type('application_json');
		$this->output->set_output(json_encode($data));
	}

	public function insert_banner_data() {
		if (isset($_POST['main_cat_id']) && isset($_POST['imgs'])) {
			$data = $this->model->insert_banner_data($this->input->post('main_cat_id'), $this->input->post('imgs'));
			$this->output->set_content_type('application_json');
			$this->output->set_output(json_encode(array("result" => $data)));
		}
	}
}

/* End of file Managecategory.php */
/* Location: ./application/controllers/admin/prodman/Managecategory.php */