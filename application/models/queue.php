<?php
Class Queue extends CI_Model {

	/*
	 * Called by the receptionist to add patient to triage queue.
	 */
	function addToTriage($patient, $visit) {
				
		// First get the queue.
		
		$this->db->select('QUEUE_CONTENT');
		$this->db->from('queue');
		$this->db->where('QUEUE_NAME', "TRIAGE");
		$query = $this->db->get()->row_array();
		$queueContent = $query['QUEUE_CONTENT'];
		
		/* If queue is empty, then create a new queue and queue patient.
		 */
		 
		 $triage = new SplQueue();
		 		 
		if ($queueContent === '') {
			$triage->enqueue(array($patient, $visit));
		}
		/* Queue isn't empty - de serialize the queue and enqueue patient.
		 */
		else {
			$triage->unserialize($queueContent);
			$triage->enqueue(array($patient, $visit));
		}
		
		
		// Update triage queue.
		
		$data = array(
			'QUEUE_CONTENT' => $triage->serialize()
			);
		$this->db->where('QUEUE_NAME', 'TRIAGE');
		$this->db->update('QUEUE', $data);

		return $triage;

	}

}
?>