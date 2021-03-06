<?php
Class Visit extends CI_Model {

	function getPatientId($visit_id) {
		$this->db->select('PATIENT_ID');
		$this->db->where('VISIT_ID', $visit_id);
		$query = $this->db->get('VISIT')->row_array();
		$patient_id = $query['PATIENT_ID'];
		return $patient_id;
	}
	/*
	 * Used by the receptionist when patient arrives.
	 */
	function addVisit($patient_id) {	
		
		$data = array(
			'PATIENT_ID' => $patient_id,
			'TRIAGE_TIME' => 0,
			'EXAMINATION_TIME' => 0
			);
	
		$insert = $this->db->insert('VISIT', $data);
		$visit_id = $this->db->insert_id();
		
		return $visit_id;	
	}
	
	function updateAfterExamination($visit_id) {
		
		$this->db->set('EXAMINATION_TIME', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visit_id);
		$this->db->update('VISIT');
	}
	/*
	 * Used by the nurse after triaging.
	 */ 
	function updateVisit($visit_id, $code, $primaryComplaint, $symptom_1, $symptom_2) {
	
		$data = array (
			'CODE' => $code,
			'PRIMARY_COMPLAINT' => $primaryComplaint,
			'SYMPTOM_1' => $symptom_1,
			'SYMPTOM_2' => $symptom_2
		);
		
		$this->db->set('TRIAGE_TIME', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visit_id);
		$this->db->update('VISIT', $data);
	}
	
	/* Used by the doctor or nurse for the examination screen.
	 */
	function findVisit($visit_id) {
		$this->db->select();
		$this->db->where('VISIT_ID', $visit_id);
		$query = $this->db->get('VISIT')->row_array();
		return $query;
	}
	
	/* Returns the average time spent between registration and triage over the last given hours.
	 */
	function getAverageTimeBeforeTriage($hours) {
		$sql ="select avg(TIMESTAMPDIFF(MINUTE, REGISTRATION_TIME, TRIAGE_TIME)) 
		AS average FROM VISIT WHERE REGISTRATION_TIME >= NOW() - INTERVAL ? hour;";
		$query = $this->db->query($sql, array($hours))->row_array();
		$average = $query['average'];
		
		if ($average == null) {
			$average = 0.0;
		}
		return $average;
	}
	
		function getAverageTimeSpentInEachCode($code, $hours) {
			
		$sql = "select avg(TIMESTAMPDIFF(MINUTE, TRIAGE_TIME, EXAMINATION_TIME)) 
			AS average FROM VISIT WHERE CODE = ? AND TRIAGE_TIME >= NOW() - INTERVAL ? hour;";
		$query = $this->db->query($sql, array($code, $hours))->row_array();
		$average = $query['average'];
		
		if ($average == null) {
			$average = 0.0;
		}
		return $average;
	}
	
	function getTotalPatientsExaminedInCode($code, $hours) {
		$sql = "select count(*) as code from visit WHERE code = ? 
		AND examination_time != 0 AND EXAMINATION_TIME >= NOW() - INTERVAL ? hour";
		$query = $this->db->query($sql, array($code, $hours))->row_array();
		$totalPatients = $query['code'];
		return $totalPatients;
	}
	

}
?>