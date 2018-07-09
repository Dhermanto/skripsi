<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credit extends MX_Controller{

    public function __construct(){
        parent::__construct();
		$this->page->template('app_tpl');
		$this->load->model('credit_model');

        if(!($this->session->userdata('pengguna'))) {
			redirect(base_url('login/admin'));
		}
        else if(($this->session->userdata('user'))) {
			redirect(base_url('apps'));
		}
    }

    public function index($q_encoded = 'x') //tampilan
	{
        $this->credit_model->set_filter($q_encoded);
		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'trx_no' => array('text' => 'trx no'),
				'trx_date' => array('text' => 'trx date'),
                'customer_name' => array('text' => 'customer name'),
				'credit_point' => array('text' => 'credit point', 'align' => 'right'),
				'credit_exp_date' => array('text' => 'credit exp date', 'align' => 'center'),
			),
			'num_rows' => $this->credit_model->num_rows(),
			'item' => 'id',
			'warning' => 'id',
			'order' => 'desc',
			// 'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->credit_model->set_grid_params($this->grid->params());
		$this->grid->source($this->credit_model->get());

		$this->page->view('credit_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'param' => $q_encoded,
			'excel_url' => $this->page->base_url("/excel"),
			'filter' => $this->credit_model->filter,
			'keyword' => $this->credit_model->keyword,
			'grid' => $this->grid->draw(),   //data table
			'pagelink' => $this->grid->page_link(), //data paging
		));
	}

	public function excel($q_encoded = '')
    {
    	$this->credit_model->set_filter($q_encoded);
		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'trx_no' => array('text' => 'trx no'),
				'trx_date' => array('text' => 'trx date'),
                'customer_name' => array('text' => 'customer name'),
				'credit_point' => array('text' => 'credit point', 'align' => 'right'),
				'credit_exp_date' => array('text' => 'credit exp date', 'align' => 'center'),
			),
			'num_rows' => $this->credit_model->num_rows(),
			'item' => 'trx_no',
			'warning' => 'customer_id',
			// 'sorting' => FALSE,
			'checkbox' => FALSE,
		));
		$this->grid->disable_all_acts();
		$this->credit_model->set_grid_params($this->grid->params());
		$this->grid->source($this->credit_model->get());

		$konten = $this->load->view('result_excel', array (
			'grid' => $this->grid->draw(),   //data table
		),true);
		excel_header('credit_point'.date('YmdHis').'.xls');
		echo $konten;
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
		$this->page->view('credit_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->credit_model->by_id($id),
			'id' => $id,
            'customer_name' => $this->credit_model->get_customer(), //tambah dan edit
		));
	}


	public function tambah()
	{
		$this->form();
	}


	public function edit($id)
	{
		$this->form('update', $id);
	}


	public function form_data()
	{
		$names = array('customer_name', 'trx_no', 'trx_date', 'credit_point', 'credit_exp_date', 'customer_id', 'remarks');
		return form_data($names);
	}


	public function insert()
	{
		$data              = $this->form_data();

        $customer_id       = $this->credit_model->get_id($data['customer_name'])->row_array();

        $data_customer             = array(
            'trx_no'            => code_credit_point(),
            'trx_date'          => $data['trx_date'],
            'credit_point'      => $data['credit_point'],
            'credit_exp_date'   => $data['credit_exp_date'],
            'customer_id'       => $customer_id['id'],
            'remarks'           => $data['remarks'],
        );

        $data_journal       = array(
            'credit_point'      => $data['credit_point'],
            'credit_exp_date'   => $data['credit_exp_date'],
            'customer_id'       => $customer_id['id'],
            'remarks'           => $data['remarks'],
        );

        db_insert('customer_credits', $data_customer);
        db_insert('customer_journals', $data_journal);

		// redirect
		$this->session->set_flashdata('success', 'Data berhasil dibuat');
		redirect($this->page->base_url());
	}


	public function update($id)
	{
		$data              = $this->form_data();

        $customer_id       = $this->credit_model->get_id($data['customer_name'])->row_array();

        if($customer_id['id'] != null) {
            $data_customer             = array(
                'trx_date'          => $data['trx_date'],
                'credit_point'      => $data['credit_point'],
                'credit_exp_date'   => $data['credit_exp_date'],
                'customer_id'       => $customer_id['id'],
                'remarks'           => $data['remarks'],
            );

            $data_journal       = array(
                'credit_point'      => $data['credit_point'],
                'credit_exp_date'   => $data['credit_exp_date'],
                'customer_id'       => $customer_id['id'],
                'remarks'           => $data['remarks'],
            );
            db_update('customer_credits', $data_customer, array('customer_id' => $customer_id['id']));
    		db_update('customer_journals', $data_journal, array('customer_id' => $customer_id['id']));
        }

        else {
            $data_customer             = array(
                'trx_date'          => $data['trx_date'],
                'credit_point'      => $data['credit_point'],
                'credit_exp_date'   => $data['credit_exp_date'],
                'customer_id'       => $data['customer_id'],
                'remarks'           => $data['remarks'],
            );

            $data_journal       = array(
                'credit_point'      => $data['credit_point'],
                'credit_exp_date'   => $data['credit_exp_date'],
                'customer_id'       => $data['customer_id'],
                'remarks'           => $data['remarks'],
            );
            db_update('customer_credits', $data_customer, array('customer_id' => $data['customer_id']));
    		db_update('customer_journals', $data_journal, array('customer_id' => $data['customer_id']));
        }

        // db_update('customer_credits', $data, array('id' => $id));
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
        $sql    = "SELECT * FROM customer_credits WHERE id = $id";
        $query  = $this->db->query($sql)->row_array();


        db_delete('customer_credits', array('id' => $id));
		db_delete('customer_journals', array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
