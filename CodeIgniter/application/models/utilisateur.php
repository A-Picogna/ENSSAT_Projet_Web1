<?php

    class utilisateur extends CI_Model{
        
        /*
        * On recupere les données
        * lié à l'enseignant qui vient de log
        * pour charger les variables de sessions
        */
        function verif_login_bdd($login, $mdp){

            $this -> db -> select('login, pwd, nom, prenom, statut, administrateur, actif');
            $this -> db -> from('enseignant');
            $this -> db -> where('login', $login);
            $this -> db -> where('pwd', $mdp);
            $this -> db -> limit(1);

            $query = $this -> db -> get();

            if($query -> num_rows() == 1){
                return $query->result();
            }
            else{
                return false;
            }
        }
        
        /*
        * fonction qui retourne vrai si le login
        * passé en parametre existe déja dans la base
        */
        function dejaPris($login){
            $this -> db -> select('login');
            $this -> db -> from('enseignant');
            $this -> db -> where('login', $login);
            $this -> db -> limit(1);

            $query = $this -> db -> get();

            if($query -> num_rows() == 1){
                return true;
            }
            else{
                return false;
            }
        }
        /*
        * Recupère les info d'un utilisateur
        */
        function get_info_utilisateur($login){
            $this -> db -> select('login, pwd, nom, prenom, statut, administrateur, actif, statutaire');
            $this -> db -> from('enseignant');
            $this -> db -> where('login', $login);
            $this -> db -> limit(1);

            $query = $this -> db -> get();

            if($query -> num_rows() == 1){
                return $query->row_array();
            }
            else{
                return false;
            }
        }
        
        /*
        * Insere un nouvel utilisateur dans la base en definissant
        * son etat à 1 automatiquement
        */
        function inserer_utilisateur($login, $mdp, $nom, $prenom, $statut, $admin){
            $this -> db -> select('login');
            $this -> db -> from('enseignant');
            $this -> db -> where('login', $login);
            $this -> db -> limit(1);            
            $query = $this -> db -> get();
            if($query -> num_rows() == 1){
                return false;
            }
            else{
                $data = array(  
                            'login' => $login,
                            'pwd' => $mdp,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'statut' => $statut,
                            'actif' => 1,
                            'administrateur' => $admin
                        );

                $this->db->insert('enseignant', $data);
                return true;
            }
        }
        
        /*
        * retourne la liste de tout les utilisateurs avec leurs données correspondantes
        */
        function getListeUtilisateurs(){
            $query = $this->db->query(' SELECT login,nom,prenom,statut,statutaire,actif,administrateur, decharge
                                        FROM enseignant LEFT JOIN decharge
                                        ON enseignant.login = decharge.enseignant
                                        ORDER BY nom');
            $i = 0;
                            $liste_utilisateurs = array();
            foreach ($query->result() as $row){
                $tmp_decharge = $row->decharge;
                if (empty($tmp_decharge)){
                    $tmp_decharge = 0;
                }
                $liste_utilisateurs[$i] = array(    'login' => $row->login,
                                                    'nom' => $row->nom,
                                                    'prenom' => $row->prenom,
                                                    'statut' => $row->statut,
                                                    'decharge' => $tmp_decharge,
                                                    'statutaire' => $row->statutaire,
                                                    'actif' => $row->actif,
                                                    'administrateur' => $row->administrateur
                                                );
                $i++;
            }
            return $liste_utilisateurs;            
        }
        
        /* 
        * Recupère les identifiants utilisateur avec sa valeur de service
        */
        
        function getServiceUtilisateurs(){
            $query = $this->db->query(' SELECT login,nom,prenom,statutaire,service
                                        FROM services
                                        ORDER BY nom');
            $i = 0;
            $liste_utilisateurs = array();
            foreach ($query->result() as $row){
                $liste_utilisateurs[$i] = array(    'login' => $row->login,
                                                    'nom' => $row->nom,
                                                    'prenom' => $row->prenom,
                                                    'statutaire' => $row->statutaire,
                                                    'service' => $row->service,
                                                );
                $i++;
            }
            return $liste_utilisateurs;            
        }
        
        /*
        * Met a jour un utilisateur avecl es valeurs passées en parametres
        * si les valeur de mot de passe est vide, on ne fait rien
        */
        function update_utilisateur($login, $mdp, $nom, $prenom, $statut, $statutaire, $admin){
            if (empty($mdp)){
                $data = array(
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'statut' => $statut,
                                'statutaire' => $statutaire,
                                'administrateur' => $admin,
                                );
            }
            else{
                $data = array(
                                'pwd' => $mdp,
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'statut' => $statut,
                                'statutaire' => $statutaire,
                                'administrateur' => $admin,
                                );
            }                
            $this->db->where('login', $login);
            $this->db->update('enseignant', $data); 
        }
        /*
        * affecte un nouvel etat passé en parametre à l'utilisateur
        */
        function changer_etat_utilisateur($login, $nouvel_etat){
                 $data = array(
                                'actif' => $nouvel_etat,
                                );                
            $this->db->where('login', $login);
            $this->db->update('enseignant', $data); 
        }
        
        /*
        * Supprime un utilisateur et supprime tout mention de lui
        * dans les autres tables, on supprime en premier les clef etrangeres
        */
        function supprimer_utilisateur($login){            
            $this->db->where('enseignant', $login);
            $this->db->update('contenu', array('enseignant' => NULL));
            
            $this->db->where('responsable', $login);
            $this->db->update('module', array('responsable' => NULL));
            
            $this->db->delete('decharge', array('enseignant' => $login));
            $this->db->delete('enseignant', array('login' => $login));
            
            redirect('administration/listeUtilisateurs', 'refresh');
        }

        /*
        * récupère la valeur de decharge d'un utilisateur
        * passé en paramètre
        */
        function get_decharge($login){            
            $this -> db -> select('decharge');
            $this -> db -> from('decharge');
            $this -> db -> where('enseignant', $login);
            $this -> db -> limit(1);

            $query = $this -> db -> get();

            if($query -> num_rows() == 1){
                return $query->row_array()['decharge'];
            }
            else{
                return false;
            }
        }
        
        /*
        * Définie une valeur de décharge d'un utilisateur
        */
        function set_decharge($login, $val){
            if (!empty($val)){
                if ($this->get_decharge($login) == false){
                    $data = array(  
                            'enseignant' => $login,
                            'decharge' => $val
                        );
                    $this->db->insert('decharge', $data);
                    }
                else{
                    $this->db->where('enseignant', $login);
                    $this->db->update('decharge', array('decharge' => $val));
                }
            }
        }
        
        /*
        * récupère le nombre de statut par statut
        */
        public function getStatut()
        {
            $query = $this->db->query('SELECT statut, count(statut) from enseignant group by statut order by statut');
            if ($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                return NULL;
            }
        }
        
        /*
        * recupere les heures enseignant par enseignant
        */
        public function getheuresEnseignant()
        {
            $query = $this->db->query('SELECT nom, prenom, contenu.enseignant, sum(hed) from contenu natural join enseignant where contenu.enseignant = enseignant.login and contenu.enseignant is not null group  by contenu.enseignant');
            if ($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                return NULL;
            }
        }
        
        /*
        * recupère le nombre d'heure effectué par un enseignant
        */
        
        public function getheureslogin($login)
        {
            $query = $this->db->query('SELECT sum(hed) from contenu where enseignant ="'. $login.'"');
            if ($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                return NULL;
            }
        }
        
    }

?>