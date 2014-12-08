<?php
Class Patient extends CI_Model {
	/* Finds a patient by Patient id.
	 */
	function getPatientById($patient_id) {
		$this->db->select();
		$this->db->where('PATIENT_ID', $patient_id);
		$query = $this->db->get('PATIENT')->row_array();
		return $query;

	}
	/* Finds a patient by RAMQ id.
	 */
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

	/* Add a patient to the db.
	 */
	function addPatient($patient) {
			
		$data = array(
			'RAMQ_ID' => htmlentities($patient['ramq']),
			'FIRST_NAME' => htmlentities($patient['firstName']),
			'LAST_NAME' => htmlentities($patient['lastName']),
			'HOME_PHONE' => htmlentities($patient['homePhone']),
			'EMERGENCY_PHONE' => htmlentities($patient['emergencyPhone']),
			'PRIMARY_PHYSICIAN' => htmlentities($patient['primaryPhysician']),
			'EXISTING_CONDITIONS' => htmlentities($patient['conditions']),
			'MEDICATION_1' => htmlentities($patient['select1']),
			'MEDICATION_2' => htmlentities($patient['select2']),
			'MEDICATION_3' => htmlentities($patient['select3'])
			);
	
		$result = $this->db->insert('PATIENT', $data);
		$patient_id = $this->db->insert_id();
		
		return $patient_id;	
	}
	/* Update a patient in db.
	 */
	function updatePatient($patient, $patient_id) {
		
		$data = array(
			'RAMQ_ID' => htmlentities($patient['ramq']),
			'FIRST_NAME' => htmlentities($patient['firstName']),
			'LAST_NAME' => htmlentities($patient['lastName']),
			'HOME_PHONE' => htmlentities($patient['homePhone']),
			'EMERGENCY_PHONE' => htmlentities($patient['emergencyPhone']),
			'PRIMARY_PHYSICIAN' => htmlentities($patient['primaryPhysician']),
			'EXISTING_CONDITIONS' => htmlentities($patient['conditions']),
			'MEDICATION_1' => htmlentities($patient['select1']),
			'MEDICATION_2' => htmlentities($patient['select2']),
			'MEDICATION_3' => htmlentities($patient['select3']) );
		$this->db->where('PATIENT_ID', $patient_id);
		$this->db->update('PATIENT', $data);
	}

}
?>