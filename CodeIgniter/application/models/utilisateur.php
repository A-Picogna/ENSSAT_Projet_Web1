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
        
        function changer_etat_utilisateur($login, $nouvel_etat){
                 $data = array(
                                'actif' => $nouvel_etat,
                                );                
            $this->db->where('login', $login);
            $this->db->update('enseignant', $data); 
        }
        
        function supprimer_utilisateur($login){            
            $this->db->where('enseignant', $login);
            $this->db->update('contenu', array('enseignant' => NULL));
            
            $this->db->where('responsable', $login);
            $this->db->update('module', array('responsable' => NULL));
            
            $this->db->delete('decharge', array('enseignant' => $login));
            $this->db->delete('enseignant', array('login' => $login));
            
            redirect('administration/listeUtilisateurs', 'refresh');
        }


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

    }

?>