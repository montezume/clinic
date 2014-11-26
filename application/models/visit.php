<?php
Class Visit extends CI_Model {

	/*
	 * Used by the receptionist when patient arrives.
	 */
	function addVisit($patient_id) {	
		
		$data = array(
			'PATIENT_ID' => $patient_id,
			'TRIAGE_TIME' => null,
			'EXAMINATION_TIME' => null
			);
	
		$insert = $this->db->insert('VISIT', $data);
		$visit_id = $this->db->insert_id();

		return $visit_id;	
	}
	
	/*
	 * Used by the nurse after triaging.
	 */ 
	function updateVisit($visit_id, $code) {
	
		$data = array (
			'CODE' => $code,
			'PRIMARY_COMPLAINT' => $primary_complaint,
			'SYMPTOM_1' => $symptom_1,
			'SYMPTOM_2' => $symptom_2
		);
		
		$this->db->set('TRIAGE_TIME', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visit['VISIT_ID']);
		$this->db->update('VISIT', $data);
	}

}
?>