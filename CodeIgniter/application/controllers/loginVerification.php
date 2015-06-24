<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class loginVerification extends CI_Controller {
    /*
    * charge les modeles et interdit l'accès aux non-droits
    */
    function __construct(){
        parent::__construct();
        if (isset($this->session->userdata('info_user')['login'])){
            redirect('home', 'refresh');
        }
        else{
            //pré-chargement du modele (sinon ca ne marche pas)
            $this->load->model('utilisateur','',TRUE);
        }
    }
    // verification du formulaire
    function index(){
        $this->load->library('form_validation');
        
        //On définie les règles des données du formulaire et on appelle la fonction verif_bdd avec un callback
        $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mdp', 'Password', 'trim|required|xss_clean|callback_verif_bdd');

        // si erreur dans le formulaire, on renvoi sur le login sinon on le conduit à l'accueil
        if($this->form_validation->run() == FALSE){
            $data['titre'] = "Service de gestion des cours pour les enseignants";
            $this->load->view('header_login', $data);        
            $this->load->view('login_view');           
            $this->load->view('footer');
        }
        else{
            redirect('home', 'refresh');
        }
    }
    
    /*
    * appelle les fonction de verification
    * et verifie si le login et le mot de passe sont bon
    * auquel cas, on recupere toute ses données et on charge
    * une variable de session
    */
    function verif_bdd($mdp){
		$mdp = urldecode($mdp);
        $login = $this->input->post('login');
        $res = $this->utilisateur->verif_login_bdd($login, $mdp);

        if($res){
            $liste_resultats = array();
            foreach($res as $r){
                $liste_resultats =  array(
                                    'login' => $r->login,
                                    'nom' => $r->nom,
                                    'prenom' => $r->prenom,
                                    'statut' => $r->statut,
                                    'administrateur' => $r->administrateur,
                                    'actif' => $r->actif
                                    );
                
            }
            $this->session->set_userdata('info_user', $liste_resultats);
            return true;
        }
        else{
            $this->form_validation->set_message('verif_bdd', 'Nom utilisateur ou mot de passe incorrect');
            return false;
        }
    }
}
?>
