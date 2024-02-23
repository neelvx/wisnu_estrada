<?php 

class Karyawan extends CI_Controller {

    public function index()
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "localhost:3000");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        $data = curl_exec($ch);
        $output['data'] = json_decode($data, TRUE); 
        $this->load->view('karyawan/index', $output);
    }
    
    public function add()
    {
        $this->load->view('karyawan/add');
    }
    
    public function edit($nik)
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "localhost:3000/edit?nik=".$nik);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        $response = curl_exec($ch);
        $data = json_decode($response, TRUE);
        // print_r($data);exit;
        $output['data'] = $data['payload']['data'][0]; 
        $this->load->view('karyawan/edit', $output);
    }

    public function genereate_nik($request)  
    {
        $divisi = [
            "IT" => 10,
            "HRD" => 11,
            "FINANCE" => 12
        ];

        $datenow = substr(date('Y-m-d'), 2, 2);
        $data = $this->db->query("SELECT max(nik) as nik FROM m_karyawan")->result_array();
        $nik = $data[0]['nik'];
        
        $urutan = (int) substr($nik, 4, 4);
        $urutan++;

        $generate_nik = $divisi[$request['divisi']] . $datenow . sprintf("%04s", $urutan);
        return $generate_nik;
    }

    public function insert()  
    {
        $data['nik'] = $this->genereate_nik($_POST);
        $data['nama'] = $this->input->post('nama');
        $data['alamat'] = $this->input->post('alamat');
        $data['tgl_lahir'] = date('Y-m-d H:i:s', strtotime($this->input->post('tgl_lahir')));
        $data['divisi'] = $this->input->post('divisi');
        $data['status'] = $this->input->post('status');
        $data['created_date'] = date('Y-m-d H:i:s');
        $payload = json_encode( $data );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"localhost:3000");
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec($ch);

        $response = json_decode($server_output, TRUE);
        // Further processing ...
        if ($response['payload']['status'] == 200) { 
            $this->session->set_flashdata('success', $response['payload']['message']);
            redirect();
        } else { 
            $this->session->set_flashdata('failed', $response['payload']['message']);
            redirect();
        }

        curl_close($ch);
    }

    public function update() 
    {
        $data['nik'] = $this->input->post('nik');
        $data['nama'] = $this->input->post('nama');
        $data['alamat'] = $this->input->post('alamat');
        $data['tgl_lahir'] = date('Y-m-d H:i:s', strtotime($this->input->post('tgl_lahir')));
        $data['divisi'] = $this->input->post('divisi');
        $data['status'] = $this->input->post('status');
        $payload = json_encode( $data );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"localhost:3000/update");
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec($ch);

        $response = json_decode($server_output, TRUE);
        // Further processing ...
        if ($response['payload']['status'] == 200) { 
            $this->session->set_flashdata('success', $response['payload']['message']);
            redirect();
        } else { 
            $this->session->set_flashdata('failed', $response['payload']['message']);
            redirect();
        }

        curl_close($ch);
    }

    public function delete($nik)
    {
        $data['nik'] = $nik;
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"localhost:3000/delete");
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        
        $response = json_decode($server_output, TRUE);
        // Further processing ...
        if ($response['payload']['status'] == 200) { 
            $this->session->set_flashdata('success', $response['payload']['message']);
            redirect();
        } else { 
            $this->session->set_flashdata('failed', $response['payload']['message']);
            redirect();
        }
        
        curl_close($ch);
    }
}

?>
