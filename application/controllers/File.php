<?php
class File extends CI_Controller{
    private $imagepath;

    public function __construct(){
        parent::__construct();
        $this->imagepath = realpah(APPPATH.'../assets/uploads/');
    }

    public function upload(){
        if($this->input->post('upload')){
            $number_of_files = sizeof($_FILES['userfiles']['tmp_name']);
            $files = $_FILES['userfiles'];

            $config['upload_path'] = $this->imagepath;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;

            for($i=0;$i<$number_of_files;$i++){
               $FILES['userfile'] ['name'] = $files['name'][$i];
               $FILES['userfile'] ['type'] = $files['type'][$i];
               $FILES['userfile'] ['tmp_name'] = $files['tmp_name'][$i];
               $FILES['userfile'] ['error'] = $files['error'][$i];
               $FILES['userfile'] ['size'] = $files['size'][$i];

               $this->upload->initialize($config);
               $this->upload->do_upload('userfile');
            }
        }
        $this->load->view('upload');
    }
}
?>
