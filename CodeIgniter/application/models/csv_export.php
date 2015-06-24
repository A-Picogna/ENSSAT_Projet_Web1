<?php

    class csv_export extends CI_Model{
        
        public function get_data($choix){
            $login = $this->session->userdata('info_user')['login'];
            $query = null;
            switch ($choix) {
            case "user_liste":
                $query = $this->db->query("SELECT * FROM enseignant");
                break;
            case "recap_perso":
                $query = $this->db->query('Select module, libelle, partie, type, public, hed from contenu, module where module=ident and enseignant="'. $login .'" order by module, partie');
                break;
            }
            return $query;
        }
        
    }

?>