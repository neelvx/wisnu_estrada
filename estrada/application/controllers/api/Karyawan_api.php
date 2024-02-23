<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Karyawan_api extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan_model', 'model');
    }

    public function karyawan_get() 
    {
        $karyawan = $this->model->get_karyawan();
        
        // Set the response and exit
        if ($karyawan) :
            $this->response( $karyawan, 200 );
        endif;
    }
    
}