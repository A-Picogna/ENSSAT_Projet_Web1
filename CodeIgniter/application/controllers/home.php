<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class home extends CI_Controller {

        function __construct(){
            parent::__construct();
            session_start();
            if(!$this->session->userdata('info_user')){ 
                //If no session, redirect to login page
                redirect('login', 'refresh');                   
            }
            else{
                if (!$this->session->userdata('info_user')['actif']){
                    $this->session->set_flashdata('type_erreur', 'inactif');
                    redirect('erreur', 'refresh');
                }
            }            
            $this->load->model('utilisateur','',TRUE);

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
            $data['statutETnb'] = $this->utilisateur->getStatut();
            $data['enseignant'] = $this->utilisateur->getheuresEnseignant();
            $this->load->view('home_view', $data);
            $this->load->view('footer');
        }

        function logout(){
            $this->session->unset_userdata('info_user');
            session_destroy();
            redirect('login', 'refresh');
        }
        
        function login(){
            redirect('login', 'refresh');
        }
        
        function listeUtilisateurs(){           
            $data['titre'] = "Liste des utilisateurs";
            $data['liste_utilisateurs'] = $this->utilisateur->getServiceUtilisateurs();
            
            $this->load->view('header', $data);
            $this->load->view('affiche_liste_utilisateurs', $data);
            $this->load->view('footer');
        }
                
        function modifier_utilisateur($login){
            if ($this->session->userdata('info_user')['login'] || $this->session->userdata('info_user')['administrateur']){
                $data['titre'] = "Modifier informations";
                $data['info_user'] = $this->utilisateur->get_info_utilisateur($login);
                $data['decharge'] = $this->utilisateur->get_decharge($login);
                $this->load->view('header_admin', $data);
                $this->load->view('edit_utilisateur', $data);
                $this->load->view('footer');
            }
            else{
                if (!$this->session->userdata('info_user')['actif']){
                    $this->session->set_flashdata('type_erreur', 'admin');
                    redirect('erreur', 'refresh');
                }
            } 
        }

    }
 
?>