<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class administration extends CI_Controller {

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
                else{
                    if(!$this->session->userdata('info_user')['administrateur']){
                        $this->session->set_flashdata('type_erreur', 'admin');
                        redirect('erreur', 'refresh');
                    }            
                }
            }                        
            $this->load->model('utilisateur'); 
        }

        function index(){  
            $data['titre'] = "Service de gestion des cours pour les enseignants";            
            $this->load->view('header_admin', $data);
            $session_data = $this->session->userdata('info_user');
            $data['login'] = $session_data['login'];
            $data['nom'] = $session_data['nom'];
            $data['prenom'] = $session_data['prenom'];
            $data['statut'] = $session_data['statut'];
            $data['administrateur'] = $session_data['administrateur'];
            $data['actif'] = $session_data['actif'];
            $data['statutETnb'] = $this->utilisateur->getStatut();
            $this->load->view('admin_view', $data);
            $this->load->view('footer');
            
        }

        function ajout_utilisateur(){
            $data['titre'] = "Ajout d'un utilisateur";
            $this->load->view('header_admin', $data);
            $this->load->view('ajout_utilisateur');
            $this->load->view('footer');
        }
        
        function listeUtilisateurs(){           
            $data['titre'] = "Liste des utilisateurs";
            $data['liste_utilisateurs'] = $this->utilisateur->getListeUtilisateurs();
            $this->load->view('header_admin', $data);
            $this->load->view('admin_listeUtilisateurs_views', $data);
            $this->load->view('footer');
        }
        
        function supprimer_utilisateur($login){
            if (strcmp($login,$this->session->userdata('info_user')['login']) == 0){
                $this->session->set_flashdata('type_erreur', 'Vous ne pouvez pas vous supprimer vous-même !');
                redirect('erreur', 'refresh');
            }
            else{
                $this->utilisateur->supprimer_utilisateur($login);
                redirect('administration/listeUtilisateurs', 'refresh');
            }
        }
        
        function activer_utilisateur($login){
            $this->utilisateur->changer_etat_utilisateur($login, 1);
            redirect('administration/listeUtilisateurs', 'refresh');
        }
        
        function desactiver_utilisateur($login){
            if (strcmp($login,$this->session->userdata('info_user')['login']) == 0){
                $this->session->set_flashdata('type_erreur', 'Vous ne pouvez pas vous désactiver vous-même !');
                redirect('erreur', 'refresh');
            }
            else{
                $this->utilisateur->changer_etat_utilisateur($login, 0);
                redirect('administration/listeUtilisateurs', 'refresh');
            }
        }
        
        
    }
 
?>
