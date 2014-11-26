<?php
Class Queue extends CI_Model {

	/*
	 * Called by the receptionist to add patient to triage queue.
	 */
	function addToTriage($patient, $visit) {
				
		// First get the queue.
		
		$this->db->select('QUEUE_CONTENT');
		$this->db->where('QUEUE_NAME', "Triage");
		$queueContent = $this->db->get('QUEUE');

		/* If queue is empty, then create a new queue and queue patient.
		 */
		 
		 $triage = new SplQueue();
		 
		 return $queueContent;
		 
		if ($queueContent == '') {
			$triage->enqueue(array($patient, $visit));
		}
		/* Queue isn't empty - de serialize the queue and enqueue patient.
		 */
		else {
			$triage->unserialize($queueContent);
			$triage->unqueue(array($patient, $visit));
		}
		
		return $triage;
		
		// Update triage queue.
	}

}
?>