<?php
Class Queue extends CI_Model {

	/* Peeks at the first patient's registration time in each queue, and returns
	* the code name with the most recent registration.
	* This method does NOT alter the queue in the database.
	*/
	
	function compareTwoQueues($queueName1, $queueName2) {
	    
	    
	}
	
	
	
	function compareQueues($queue1, $queue2, $queue3 = -1, $queue4 = -1) {
		// Get the triage queues.
		$queue1Obj = $this->getQueue($queue1);
		$queue2Obj = $this->getQueue($queue2);
		
		// this method works with up to four queues, that's why there are default
		// values
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
		// if there are multiple visit ids
		if (count($data) > 1) {
		
			$this->db->select("code");
			$this->db->where_in('visit_id', $data);
			$this->db->order_by('registration_time', 'asc');
			$this->db->limit(1);
			$query = $this->db->get('VISIT')->row_array();
			return $query['code'];
		}
		// there is just one code with a patient, return it.
		else {
		    if (count($data) == 1) {
		         return key($data);
		    }
		    else {
			// none of the queues have patients present.
			return -1;
			}
			
        }
    }
    /* Returns the length of the queue.
     */
	function getLengthOfQueue($queueName) {
		// Get the triage queue.
		$queue = $this->getQueue($queueName);
		return $queue->count();
	}
    
    /* Dequeues a patient from the front of the given queue and then
     * updates the DB. Safe from concurrency issues due to transactions and
    * locking.
    * Returns either the visit_id or -1 if the queue is empty, or
    * -2 if there is a concurrency issue and rollback occured.
    */ 
	function getNextVisitId($queueName) {
	
	    // start the Transaction.
		$this->db->trans_start();
		// SQL statement.
		$sql = "SELECT queue_content FROM queue WHERE queue_name = ? FOR UPDATE";
		// Execite SQL statement.
		$query = $this->db->query($sql, array($queueName))->row_array();
		// Get the queue content
		//var_dump($query);
		$queueContent = $query["queue_content"];
		
		$queue = new SplQueue();
		$nextVisitId = -1;
        // if queue exists.
		if ($queueContent != '') {
			$queue->unserialize($queueContent);
			// if there is a  patient, dequeue them.
			if (count($queue) > 0) {
			    $nextVisitId = $queue->dequeue();
			}
		}
		
		$this->updateQueue($queue, $queueName);
	
		$this->db->trans_complete(); //commits or rollback the transaction, releases locks
		
		if ($this->db->trans_status() === FALSE) {
				return -2;
		} 
		
		return $nextVisitId;
		
	}
	
	/*
	 * Returns the first visit id in the queue and updates the queue.
	 * This method is deprecated, as it does not deal with concurrency
	 * issues.
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
	 * 
	 */
	function addToQueue($visit, $queueName) {
		
	    // start the Transaction.
		$this->db->trans_start();
		// SQL statement.
		$sql = "SELECT queue_content FROM queue WHERE queue_name = ? FOR UPDATE";
		// Execite SQL statement.
		$query = $this->db->query($sql, array($queueName))->row_array();
		// Get the queue content
		$queueContent = $query["queue_content"];
        
		$queue = new SplQueue();

        // if queue exists.
		if ($queueContent != '') {
			$queue->unserialize($queueContent);
		}
		
		$queue->enqueue($visit);
		
		$insert = $this->updateQueue($queue, $queueName);
	
		$this->db->trans_complete(); //commits or rollback the transaction, releases locks
		
		if ($this->db->trans_status() === FALSE) {
				return -2;
		}
		// Update queue table.
		return $insert;
	}

	
	/* Accepts an SplQueue, and updates the corresponding table with it.
	 */
	private function updateQueue($queue, $queueName) {
		$data = array(
			'QUEUE_CONTENT' => $queue->serialize()
			);
		$this->db->where('QUEUE_NAME', (int)$queueName);
		$insert = $this->db->update('QUEUE', $data);
		return $insert;

	}
	/* Returns the queue with the corresponding name,
	 * or an email queue if it doesn't exist.
	 */
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