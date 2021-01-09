<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class W extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('w_m2');
        
//        (-(7/12) * (log2 (7/12)) + (-(5/12) * (log2 (5/12))
    }

    
    function ss(){
         $semua = $this->m_data->seluruh2()->result();
        $no=0;
        foreach($semua as $s){
        $no++;
//            echo $s->id."<br>";
            $data = array(
                'petal_length' => $s->petal_length
            );
            $this->db->insert('petal_length',$data);
        }
    }
    
    function haha(){
        $semua = $this->m_data->seluruh2()->result();
        $no=0;
        foreach($semua as $s){
        $no++;
//            echo $s->id."<br>";
            $data = array(
                'buying' => $s->buying,
                'maint' => $s->maint,
                'doors' => $s->doors,
                'persons' => $s->persons,
                'lug_boot' => $s->lug_boot,
                'safety' => $s->safety,
                'class_values' => $s->class_values
            );
            $this->db->insert('again3_tes',$data);
            $this->m_data->hapus_data(array('id' => $s->id),'again3');
        }
    }
}
