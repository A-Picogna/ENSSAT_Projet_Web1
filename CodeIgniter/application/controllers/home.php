<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    session_start();

    class home extends CI_Controller {

        function __construct(){
            parent::__construct();            
        }

        function index(){
        $data['title'] = "Service de gestion des cours pour les enseignants";            
        $this->load->view('header', $data);        
            if($this->session->userdata('connecte')){
                $session_data = $this->session->userdata('connecte');
                $data['login'] = $session_data['login'];
                $data['nom'] = $session_data['nom'];
                $data['prenom'] = $session_data['prenom'];
                $data['statut'] = $session_data['statut'];
                $data['administrateur'] = $session_data['administrateur'];
                $this->load->view('home_view', $data);
            }
            else{
                //If no session, redirect to login page
                redirect('login', 'refresh');
            }            
        $this->load->view('footer');
        }

        function logout(){
            $this->session->unset_userdata('connecte');
            session_destroy();
            redirect('home', 'refresh');
        }

        function ajout_utilisateur(){
            if($this->session->userdata('connecte')){




            }
            else{
                //If no session, redirect to login page
                redirect('login', 'refresh');
            }
        }


    }
 
?>