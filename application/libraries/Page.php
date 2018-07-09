<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DN_Library
 *
 * Arga Dinata Library for CodeIgniter 2.1.3
 *
 * @package		DN_Library
 * @author		Arga Dinata
 * @email		arga_dinata@yahoo.com
 * @copyright	Copyright (c) 2012
 * @since		Version 2.0
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 * DN_Library 	MY_Page Class
 *
 * Class to manage template page
 *
 * @package		DN_Library
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Arga Dinata
 */

class MY_Page {

	private $_CI;							// instance of CodeIgniter Class
	private $_dir			= FALSE;		// wheter the controller use directory or not
	private $_base_url;						// page Base URL
	private $_data			= array();		// data variables sent to View Class
	private $_content		= '';			// page content
	private $_template		= 'site_tpl';	// default template
	private $_title 		= '';			// page title

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * Creates CI Class instance
	 */
	public function __construct()
	{
		$this->_CI =& get_instance();

		// define page base URL
		$first = $this->_CI->uri->segment(1);
		$second	= '';

		if ($first == '') {
			$first = $this->_CI->router->class;
		}
		else {
			$second	= $this->_CI->uri->segment(2);
		}

		$this->_base_url = $this->_dir ? site_url($first.'/'.$second) : site_url($first);

		// others
		$this->_CI->load->library('user_agent');
		$prev = $this->_CI->agent->referrer();
		$this->_back = $prev == '' ? $this->_base_url : $prev;

		// login status
		// $uri = $this->_CI->uri->segment(1);
		// 	if( empty($this->_CI->session->userdata('pengguna'))) {
		// 		if( ($uri != 'login') && ($uri != 'auth')  ) {
		// 			redirect(base_url('login'));
		// 		}
		// 	}
		// 	if (empty($this->_CI->session->userdata('user'))) {
		// 		if( ($uri != 'apps') && ($uri != 'site/customer') ) {
		// 			redirect(base_url('apps/login'));
		// 		}
		// 	}
	}

	// --------------------------------------------------------------------

	/**
	 * Get page base URL
	 *
	 * @return	string
	 */
	function base_url($uri = '')
	{
		// check first slash
		if ($uri != '') {
			if ($uri[0] != '/') {
				$uri = '/'.$uri;
			}
		}

		// return the base URL
		return $this->_base_url.$uri;
	}

	// --------------------------------------------------------------------

	/**
	 * use_directory
	 *
	 */
	function use_directory()
	{
		$this->_dir = TRUE;
		$dir = $this->_CI->uri->segment(1);
		$controller	= $this->_CI->uri->segment(2);
		$this->_base_url = site_url($dir.'/'.$controller);
	}

	// --------------------------------------------------------------------

	/**
	 * Set the title
	 *
	 * @param	string
	 */
	function title($title)
	{
		$this->_title = $title;
	}

	// --------------------------------------------------------------------

	/**
	 * Set data sent to view class
	 *
	 * @param	arrayview
	 */
	function _data($values)
	{
		foreach ($values as $key => $value) {
			$this->_data[$key] = $value;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set content of the page
	 *
	 * @param	string
	 */
	function _content($content)
	{
		$this->_content = $content;
	}

	// --------------------------------------------------------------------

	/**
	 * Set template
	 *
	 * @param	string
	 */
	function template($template)
	{
		$this->_template = $template;
	}

	// --------------------------------------------------------------------

	/**
	 * Set data for template
	 */
	function _set_data()
	{
		foreach ($this as $key => $value) {
			if ($key != '_CI' && $key != '_data') {
				$key = substr($key, 1);
				$this->_data[$key] = $value;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Display the page
	 */
	function view($content = '___null___', $data = array())
	{
		$this->_content($content);
		$this->_data($data);

		$this->_set_data();
		$this->_CI->load->view('templates/'.$this->_template, $this->_data);
		//$this->_CI->load->view('ilearn_frontend/'.$this->_template, $this->_data);
	}

}

// END MY_Page class

/* End of file Page.php */
/* Location: ./application/libraries/Page.php */
