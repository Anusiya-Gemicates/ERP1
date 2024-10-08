<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_team_members();

    }

    public function index() {
        
    }
    private function can_access_clients() {
        $permissions = $this->login_user->permissions;
        if ($this->login_user->is_admin || get_array_value($permissions, "client")) {
            return true;
        }
    }

    private function can_access_vendors() {
        $permissions = $this->login_user->permissions;
        if ($this->login_user->is_admin || get_array_value($permissions, "vendor")) {
            return true;
        }
    }

    /*private function can_access_company() {
        $permissions = $this->login_user->permissions;
        if ($this->login_user->is_admin || get_array_value($permissions, "company")) {
            return true;
        }
    }*/
     private function can_access_company() {
        //$permissions = $this->login_user->permissions;
         $access_company = $this->get_access_info("company");
        if ($this->login_user->is_admin || ($access_company->access_type=="all" || in_array($this->login_user->id, $access_company->allowed_members))) {
            return true;
        }
    }

    private function can_manage_all_projects() {
        if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "can_manage_all_projects") == "1") {
            return true;
        }
    }

    function search_modal_form() {
        $search_fields = array(
            "task",
            "project",
            
        );

        if ($this->can_access_clients()) {
            $search_fields[] = "client";
        }

        if ($this->can_access_vendors()) {
            $search_fields[] = "vendor";
        }
        if ($this->can_access_company()) {
            $search_fields[] = "company";
        }
        if (get_setting("module_todo")) {
            $search_fields[] = "todo";
        }

        $search_fields_dropdown = array();
        foreach ($search_fields as $search_field) {
            $search_fields_dropdown[] = array("id" => $search_field, "text" => lang($search_field));
        }

        $view_data['search_fields_dropdown'] = json_encode($search_fields_dropdown);

        $this->load->view("search/modal_form", $view_data);
    }

    function get_search_suggestion() {
        $search = $this->input->post("search");
        $search_field = $this->input->post("search_field");

        if ($search && $search_field) {
            $options = array();
            $result = array();

            if ($search_field == "task") { //task
                $options["show_assigned_tasks_only_user_id"] = $this->login_user->id;
                $result = $this->Tasks_model->get_search_suggestion($search, $options)->result();
            } else if ($search_field == "project") { //project
                if (!$this->can_manage_all_projects()) {
                    $options["user_id"] = $this->login_user->id;
                }
                $result = $this->Projects_model->get_search_suggestion($search, $options)->result();
            } else if ($search_field == "client") { //client
                if (!$this->can_access_clients()) {
                    redirect("forbidden");
                }
                //$options["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
                $result = $this->Clients_model->get_search_suggestion($search, $options)->result();
            }else if ($search_field == "vendor") { //client
                if (!$this->can_access_vendors()) {
                    redirect("forbidden");
                }
                //$options["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
                $result = $this->Vendors_model->get_search_suggestion($search, $options)->result();
            }else if ($search_field == "company") { //client
                if (!$this->can_access_company()) {
                    redirect("forbidden");
                }
                //$options["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
                $result = $this->Companys_model->get_search_suggestion($search, $options)->result();
            } else if ($search_field == "todo" && get_setting("module_todo")) { //todo
                $result = $this->Todo_model->get_search_suggestion($search, $this->login_user->id)->result();
            }

            $result_array = array();
            foreach ($result as $value) {
                if ($search_field == "task") {
                    $result_array[] = array("value" => $value->id, "label" => lang("task") . " $value->id: " . $value->title);
                } else if ($search_field == "company") {
                    $result_array[] = array("value" => $value->cr_id, "label" => $value->title);
                }else {
                    $result_array[] = array("value" => $value->id, "label" => $value->title);
                }
            }

            echo json_encode($result_array);
        }
    }

}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */