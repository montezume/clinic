<?php
Class Queue extends CI_Model {

	function getLengthOfQueue($queueName) {
		// Get the triage queue.
		$queue = $this->getQueue($queueName);	 	 
		
		return $queue->count();
	}

	/*
	 * Called by the nurse to get the first patient in the triage queue.
	 */
	function getNextPatient($queueName) {
		
		// Get the triage queue.
		$queue = $this->getQueue($queueName);	 	 
		// Dequeue next patient if exists.
		
		if ($queue->count() > 0) {
			$nextVisitId = $queue->dequeue();
		}
		else {
			$nextVisitId = -1;
		}
		// Update queue if patient existed.
		if ($nextVisitId != -1) {
			$this->updateQueue($queue, $queueName);
		}
		
		return $nextVisitId;
	}

	/*
	 * Called by the receptionist to add patient to triage queue.
	 */
	function addToQueue($visit, $queueName) {
		
		// Get the queue
		$queue = $this->getQueue($queueName);	 	 
		// Add visit id to the queue.
		$queue->enqueue($visit);
		
		// Update queue table..
		$insert = $this->updateQueue($queue, $queueName);
		
		return $insert;
	}

	/* Accepts an SplQueue, and updates the corresponding table with it.
	 */
	private function updateQueue($queue, $queueName) {
		$data = array(
			'QUEUE_CONTENT' => $queue->serialize()
			);
		$this->db->where('QUEUE_NAME', $queueName);
		$insert = $this->db->update('QUEUE', $data);
		return $insert;

	}
	private function getQueue($queueName) {
		
		// First get the queue.
		
		$this->db->select('QUEUE_CONTENT');
		$this->db->from('queue');
		$this->db->where('QUEUE_NAME', $queueName);
		$query = $this->db->get()->row_array();
		$queueContent = $query['QUEUE_CONTENT'];
 
		$queue = new SplQueue();
		 
		 /* If queue is empty, then return the new empty queue.
		 */
		if ($queueContent === '') {
			return $queue;
		}
		/* Queue isn't empty - de serialize the queue and return
		 */
		else {
			$queue->unserialize($queueContent);
			return $queue;
		}
		
	}
}
?>