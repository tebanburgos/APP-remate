<?php
class Form extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
    public function index(){
        // Cargar vista de formulario
        $this->load->view('form_view');
    }
    public function getForm(){
        // Reglas de validacion
        $this->form_validation->set_rules(
            'username',
            'Usuario',
            'required|min_length[5]|max_length[12]'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|matches[passconf]'
        );
        $this->form_validation->set_rules(
            'passconf',
            'Confirmar password',
            'required'
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email'
        );
        // Verificar validacion correcta
        if ($this->form_validation->run() == FALSE){
            // Retornar errores de validacion
            echo validation_errors();
        }else{
            echo "Validacion correcta :)";
        }        
    }
}

?>