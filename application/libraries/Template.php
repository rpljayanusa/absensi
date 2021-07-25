<?php
class Template
{
    protected $_ci;
    function __construct()
    {
        $this->_ci = &get_instance();
    }
    function display($template, $data = null)
    {
        $data['content'] = $this->_ci->load->view($template, $data, true);
        $this->_ci->parser->parse('layout/index', $data);
    }
    public function modal_form($form, $data)
    {
        $d['body'] = $this->_ci->load->view($form, $data, true);
        $this->_ci->load->view('layout/modal_form', $d);
    }
    public function modal_info($form, $data)
    {
        $d['body'] = $this->_ci->load->view($form, $data, true);
        $this->_ci->load->view('layout/modal_info', $d);
    }
}
