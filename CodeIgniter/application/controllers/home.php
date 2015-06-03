<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    session_start();

    class home extends CI_Controller {

        function __construct(){
            parent::__construct();
            if($this->session->userdata('info_user')){
                if (!$this->session->userdata('info_user')['actif']){
                    $this->session->set_flashdata('type_erreur', 'inactif');
                    redirect('erreur', 'refresh');
                }                    
            }
            else{
                //If no session, redirect to login page
                redirect('login', 'refresh');
            }
        }

        function index(){ 
            $data['titre'] = "Service de gestion des cours pour les enseignants";            
            $this->load->view('header', $data);
            $session_data = $this->session->userdata('info_user');
            $data['login'] = $session_data['login'];
            $data['nom'] = $session_data['nom'];
            $data['prenom'] = $session_data['prenom'];
            $data['statut'] = $session_data['statut'];
            $data['administrateur'] = $session_data['administrateur'];
            $data['actif'] = $session_data['actif'];
            $this->load->view('home_view', $data);
            $this->load->view('footer');
        }

        function logout(){
            $this->session->unset_userdata('info_user');
            session_destroy();
            redirect('login', 'refresh');
        }

        function ajout_utilisateur(){
            if (!$this->session->userdata('info_user')['administrateur']){
                $this->session->set_flashdata('type_erreur', 'admin');
                redirect('erreur', 'refresh');
            }
            else{ 
                $data['titre'] = "Ajout d'un utilisateur";
                $this->load->view('header', $data);
                $this->load->view('ajouter_utilisateur');
                $this->load->view('footer');
            }
        }
        
        function login(){
            redirect('login', 'refresh');
        }


    }
 
?>