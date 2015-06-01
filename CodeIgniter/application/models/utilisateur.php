<?php

    class utilisateur extends CI_Model{
        
        function verif_login_bdd($login, $mdp){

            $this -> db -> select('login, pwd, nom, prenom, statut, administrateur');
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

        function inserer_utilisateur($login, $mdp, $nom, $prenom, $statut){
            $data = array(  
                        'login' => $login,
                        'pwd' => $mdp,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'statut' => $statut,
                        'actif' => 1,
                        'administrateur' => 0
                    );

            $this->db->insert('enseignant', $data); 
        }
    }

?>