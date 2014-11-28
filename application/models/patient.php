<?php
Class Patient extends CI_Model {
	
	function getPatientById($patient_id) {
		$this->db->select();
		$this->db->where('PATIENT_ID', $patient_id);
		$query = $this->db->get('PATIENT')->row_array();
		return $query;

	}
	
	function findPatient($ramq) {
		
		$sql = "SELECT * from PATIENT where RAMQ_ID = ?";
		$patient = $this->db->query($sql, array($ramq))->row_array();

		if ( count($patient) != 0) {
			// a record was retrieved from the db.	
			return $patient;
		}

		else {
			// no patient found.
			return false;
		}
	}
	

	function addPatient($patient) {
			
		$data = array(
			'RAMQ_ID' => $patient['ramq'],
			'FIRST_NAME' => $patient['firstName'],
			'LAST_NAME' => $patient['lastName'],
			'HOME_PHONE' => $patient['homePhone'],
			'EMERGENCY_PHONE' => $patient['emergencyPhone'],
			'PRIMARY_PHYSICIAN' => $patient['primaryPhysician'],
			'EXISTING_CONDITIONS' => $patient['conditions'],
			'MEDICATION_1' => $patient['select1'],
			'MEDICATION_2' => $patient['select2'],
			'MEDICATION_3' => $patient['select3'] );
	
		$result = $this->db->insert('PATIENT', $data);
		$patient_id = $this->db->insert_id();
		
		return $patient_id;	
	}
	
	function updatePatient($patient, $patient_id) {
		
		$data = array(
			'RAMQ_ID' => $patient['ramq'],
			'FIRST_NAME' => $patient['firstName'],
			'LAST_NAME' => $patient['lastName'],
			'HOME_PHONE' => $patient['homePhone'],
			'EMERGENCY_PHONE' => $patient['emergencyPhone'],
			'PRIMARY_PHYSICIAN' => $patient['primaryPhysician'],
			'EXISTING_CONDITIONS' => $patient['conditions'],
			'MEDICATION_1' => $patient['select1'],
			'MEDICATION_2' => $patient['select2'],
			'MEDICATION_3' => $patient['select3'] );
		$this->db->where('PATIENT_ID', $patient_id);
		$this->db->update('PATIENT', $data);
	}

}
?>