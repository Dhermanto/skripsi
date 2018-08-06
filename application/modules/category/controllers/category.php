<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller{

    public function __construct(){
        parent::__construct();
		$this->page->template('app_tpl');
		$this->load->model('category_model');

        if(!($this->session->userdata('pengguna'))) {
			redirect(base_url('login/admin'));
		}
        else if(($this->session->userdata('user'))) {
			redirect(base_url('apps'));
		}
    }

    public function index($q_encoded = 'x')
	{
        $this->category_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
                'category_name' => array('text' => 'Category Name'),
                'content' => array('text' => 'Content', 'func' => 'content'),
			),
			'num_rows' => $this->category_model->count()->num_rows(),
			'item' => 'id',
			'warning' => 'id',
			'order' => 'desc',
			'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->category_model->set_grid_params($this->grid->params());
		$this->grid->source($this->category_model->get());

		$this->page->view('category_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->category_model->filter,
			'keyword' => $this->category_model->keyword,
			'grid' => $this->grid->draw(),   //data table
			'pagelink' => $this->grid->page_link(), //data paging
		));
	}

    public function filter()
    {
        $q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
    }

    public function search()
	{
		$q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
	}


	public function form($action = 'insert', $id = '')
	{
		$this->page->view('category_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->category_model->by_id($id),
			'id' => $id,
		));
	}


	public function tambah()
	{
		$this->form();
	}

    public function insert()
	{
        $data = $this->form_data();

        db_insert('category', $data);
        $this->session->set_flashdata('success', 'Data berhasil dibuat');
		redirect($this->page->base_url());
    }


	public function edit($id)
	{
		$this->form('update', $id);
	}


	public function form_data()
	{
		$names = array('category_name', 'content');
		return form_data($names);
	}

	public function update($id)
	{
		$data = $this->form_data();
		db_update('category', $data, array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
		db_delete('category', array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}

    public function test()
    {
        test();
    }

}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
