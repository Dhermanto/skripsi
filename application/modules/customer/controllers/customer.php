<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller{

    public function __construct(){
        parent::__construct();
		$this->page->template('app_tpl');
        $this->load->model('customer_model');

        if(!($this->session->userdata('pengguna'))) {
			redirect(base_url('login/admin'));
		}
        else if(($this->session->userdata('user'))) {
			redirect(base_url('apps'));
		}
    }

    public function index($q_encoded = 'x')
	{
        $this->customer_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'customer_logo' => array('text' => 'logo', 'func' => 'logo_thumbnail'),
				'customer_name' => array('text' => 'customer name',),
				'customer_slug' => array('text' => 'Customer ID',),
				'credit_point' => array('text' => 'credit points', 'align' => 'right'),
				'credit_exp_date' => array('text' => 'Credit Exp. Date', 'align' => 'center'),
			),
			'num_rows' => $this->customer_model->num_rows(),
			'item' => 'id',
			'warning' => 'id',
            'order' => 'desc',
			// 'sorting' => FALSE,
			'checkbox' => FALSE,
		));

        $user_group = $this->session->userdata('pengguna')->user_group;

        // if ($user_group === 'admin_bank') {
        //     $this->grid->add_actions(array(
        //         'edit' => array('show' => false),
        //         'delete' => array('show' => false),
        //     ));
        // }

        // $this->grid->add_actions(array(
        //     'give' => array('show' => TRUE, 'title' => 'Give Credits', 'icon' => 'download'),
        // ));

		$this->customer_model->set_grid_params($this->grid->params());
		$this->grid->source($this->customer_model->get());

		$this->page->view('customer_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->customer_model->filter,
			'keyword' => $this->customer_model->keyword,
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
		$this->page->view('customer_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->customer_model->by_id($id),
			'id' => $id,
		));
	}

    public function form_give($action = 'insert_give', $id = '', $userBank = '')
    {
        $this->page->view('customer_give', array (
            'action_url'    => $this->page->base_url("/$action/$id/$userBank"),
            'data'          => $this->customer_model->give_id($id),
            'id'            => $id
        ));
    }

    public function insert_give($id)
    {
        $userBank = $this->uri->segment(4);

        $jumlah           = 0;
        $credit           = $this->customer_model->give_id($id);
        $row_array        = $credit->row_array();
        $customer_id      = $row_array['customer_id'];
        $user_arr         = $this->input->post('user_id'); 
        $credit_arr       = $this->input->post('user_name'); 

        foreach ($user_arr as $key => $value) {
            $user_journals = array(
                'credit_point'  => $credit_arr[$key],
                'user_id'       => $value
            );

            db_insert('user_journals', $user_journals);
            $jumlah += (int) $credit_arr[$key];
        }

        $customer_journals = array(
            'customer_id'   => $customer_id,
            'credit_point'  => -$jumlah
        );

        db_insert('customer_journals', $customer_journals);

        if ($userBank) {
            redirect("/user_bank/index/$customer_id", "refresh");
        }
        redirect($this->page->base_url());
    }

	public function tambah()
	{
		$this->form();
	}

    public function give($id, $userBank = '')
    {
        $this->form_give('insert_give', $id, $userBank);
    }

	public function edit($id)
	{
		$this->form('update', $id);
	}


	public function form_data()
	{
		$names = array("customer_name", 'customer_phone', 'customer_email', 'customer_website', 'customer_fax', 'customer_address', 'customer_logo', 'save_give');
		return form_data($names);
	}


	public function insert()
	{
		// masukkan ke tabel pengguna
		$data             = $this->form_data();
		$file_data		  = $this->do_upload();
        $file             = $file_data['file_name'];

        if ($file === ''){
            $file = 'no-image.png';
        }

        //setting slug
        $slug             = ucwords(strtolower($data['customer_name']));
        $customer_slug    = preg_replace("/ +/", "", $slug);


        //insert customer
        $insert             = array(
            'customer_slug'    => $customer_slug,
            'customer_name'    => $data['customer_name'],
            'customer_phone'   => $data['customer_phone'],
            'customer_email'   => $data['customer_email'],
            'customer_website' => $data['customer_website'],
            'customer_address' => $data['customer_address'],
            'customer_fax'     => $data['customer_fax'],
            'customer_logo'    => $file,
        );

		db_insert('customers', $insert);

		$this->session->set_flashdata('success', 'Data berhasil dibuat');
		redirect($this->page->base_url());
	}

    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $file = $this->upload->do_upload('customer_logo');

        return $this->upload->data();
    }

	public function update($id)
	{
        $data             = $this->form_data();

        // masukkan ke tabel pengguna
		$file_data		  = $this->do_upload();
        $file             = $file_data['file_name'];

        //setting slug
        $slug             = ucwords(strtolower($data['customer_name']));
        $customer_slug    = preg_replace("/ +/", "", $slug);


        //insert customer
        $insert           = array(
            'customer_slug'    => $customer_slug,
            'customer_name'    => $data['customer_name'],
            'customer_phone'   => $data['customer_phone'],
            'customer_email'   => $data['customer_email'],
            'customer_website' => $data['customer_website'],
            'customer_address' => $data['customer_address'],
            'customer_fax'     => $data['customer_fax'],
        );
		
		if ($file != '') {
			$insert['customer_logo'] = $file;
		}
		
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
		db_update('customers', $insert, array('id' => $id));
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
        $sql = "SELECT customer_logo FROM customers WHERE id = $id";
        $data = $this->db->query($sql)->row_array();

        $url = $this->uri->segment(1);
        $base = base_url();
        $path = str_replace($url,'', $base);

        $direktori = "uploads/" . $data['customer_logo'];
        @unlink($direktori);

        db_delete('customers', array('id' => $id));
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
