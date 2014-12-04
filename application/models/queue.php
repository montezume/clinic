<?php
Class Queue extends CI_Model {

	/* Peeks at the first two patient's registration time in each queue, and returns
	* the code name with the most recent registration.
	* This method does NOT alter the queue in the database.
	*/
	function compareQueues($queue1, $queue2, $queue3 = -1, $queue4 = -1) {
		// Get the triage queues.
		$queue1Obj = $this->getQueue($queue1);
		$queue2Obj = $this->getQueue($queue2);
		
		if ($queue3 != -1) {
			$queue3Obj = $this->getQueue($queue3);
		}
		if ($queue4 != -1) {
			$queue4Obj = $this->getQueue($queue4);
		}
		
		$data = array();
		
		if ($queue1Obj->count() != 0) {
			$queue1VisitId = $queue1Obj->dequeue();
			$data[$queue1] = $queue1VisitId;
		}
		
		if ($queue2Obj->count() != 0) {
			$queue2VisitId = $queue2Obj->dequeue();
			$data[$queue2] = $queue2VisitId;
		}
				
		if ($queue3 != -1) {
			if ($queue3Obj->count() != 0) {
				$data[$queue3] = $queue3Obj->dequeue();
			}
		}
		
		if ($queue4 != -1) {
			if ($queue4Obj->count() != 0) {
				$data[$queue4] = $queue4Obj->dequeue();
			}
		}
		
		if (count($data) > 1) {
		
			$this->db->select("code");
			$this->db->where_in('visit_id');
			$this->db->order_by('registration_time', 'desc');
			$this->db->limit(1);
			$query = $this->db->get('VISIT')->row_array();
			return $query['code'];
		}
		
		else {
			// if there is only one queue with a patient in it, return
			// the queue name
			if (count($data) == 1) {
				return key($data);
			}
			else {
			// none of the queues have patients present.
				return -1;
			}
		}
	}

	function getLengthOfQueue($queueName) {
		// Get the triage queue.
		$queue = $this->getQueue($queueName);
		return $queue->count();
	}

	function getNextVisitId($queueName) {
	
		$this->db->trans_start();
		$query = $this->db->query("SELECT queue_content FROM queue WHERE queue_name = $queueName FOR UPDATE")->row_array();
		$queueContent = $query['QUEUE_CONTENT'];
		
		$queue = new SplQueue();
		$nextVisitId = -1;
		
		if ($queueContent != '') {
			$queue->unserialize($queueContent);
			$nextVisitId = $queue->dequeue();
		}
		
		$this->updateQueue($queue, $queueName);
	
		$this->db->trans_complete(); //commits or rollback the transaction, releases locks
		
		if ($this->db->trans_status() === FALSE) {
				//logic if the transaction failed. Code Igniter isn’t really object-oriented, it doesn’t throw exceptions
			} 
		
		return $nextVisitId;
		
	}
	
	/*
	 * Returns the first visit id in the queue.
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
	 * Called to add a visit id to the queue.
	 */
	function addToQueue($visit, $queueName) {
		
		// Get the queue
		$queue = $this->getQueue($queueName);	 	 
		// Add visit id to the queue.
		$queue->enqueue($visit);
		
		// Update queue table.
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
		if ($queueContent == '') {
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