<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/23/15
 * Time: 13:30
 */

class People_model extends CI_Model {
    /*
     * Get a person's information.
     */
    public function get_people($id) {
        $res = $this->db->where('id', $id)->get('people');
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return NULL;
    }

    /*
     * Get a person's name.
     */
    public function get_name($id) {
        $res = $this->db->where('id', $id)->get('people')->row_array();
        return $res['name'];
    }

    /*
     * Add a new person.
     */
    public function add_people($data, $school_id) {
        $data = array_merge($data, array('school_id', $school_id));
        $this->db->insert('people', $data);
    }

    /*
     * Delete a person.
     */
    public function delete_people($id) {
        $this->db->where('id', $id)->update('people', array('deleted' => 1));
    }

    /*
     * Add a person to a specific team.
     */
    public function add_to_team($id, $team_id) {
        $this->db->where('id', $id)->update('people', array('team_id' => $team_id));
    }

    /*
     * Get all the people from a certain school.
     *
     * ====argument====
     * $school_id, the id of the school.
     *
     * =====return=====
     * $res, an 2d array containing all the people that are not deleted.
     *
     */
    public function get_people_from_school($school_id) {
        $query = $this->db->where('school_id', $school_id)->get('people');
        return $query->result_array();
    }

}

/* End of file people_model.php */
/* Location: ./application/models/people_model.php */