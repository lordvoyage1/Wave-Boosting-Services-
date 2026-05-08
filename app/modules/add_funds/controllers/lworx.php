<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lworx extends MX_Controller
{
    public function __construct($payment = "")
    {
        parent::__construct();
        show_404();
        exit;
    }

    public function index()    { show_404(); exit; }
    public function callback() { show_404(); exit; }
    public function process()  { show_404(); exit; }
    public function return_url(){ show_404(); exit; }
}
