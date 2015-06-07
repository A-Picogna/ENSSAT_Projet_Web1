<?php

    class utilisateur extends CI_Model{
        
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
        
        function getListeUtilisateurs(){
            $query = $this->db->query(' SELECT login,nom,prenom,statut,statutaire,actif,administrateur
                                        FROM enseignant
                                        ORDER BY nom');
            $i = 0;
                            $liste_utilisateurs = array();
            foreach ($query->result() as $row){
                $liste_utilisateurs[$i] = array(    'login' => $row->login,
                                                    'nom' => $row->nom,
                                                    'prenom' => $row->prenom,
                                                    'statut' => $row->prenom,
                                                    'statutaire' => $row->statutaire,
                                                    'actif' => $row->actif,
                                                    'administrateur' => $row->administrateur
                                                );
                $i++;
            }
            return $liste_utilisateurs;            
        }
    }

?>