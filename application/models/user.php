<?php
Class User extends CI_Model {
	
	function getInvalidCount($username) {
			$sql = "SELECT INVALID_LOGIN from USER where user_name = ?";
			$query = $this->db->query($sql, array($username))->row_array();
			
			if ( count($query) != 0) {
				return $query['INVALID_LOGIN'];
			}
			else {
				return false;
			}
	}
	
	function login($username, $password) {
		
		$sql = "SELECT * from USER where user_name = ?";
		
		$login = $this->db->query($sql, array($username))->row_array();
		
		if ( count($login) != 0) {
			
			// A record was retrieved from the DB. That means there is a record that
			// matches the user id entered by the user.
			
			$passValid = password_verify($password, $login['HASHED_PASSWORD']);
			
			
			// User typed in incorrect password. Increment invalid login count.
			if (!$passValid) {
				$this->incrementInvalidLogin($login['USER_ID'], $login['INVALID_LOGIN']);
				return false;
			}
			
			else {
				if ($login['INVALID_LOGIN'] < 5) {
					// valid login, reset counter.
					$this->resetLoginCount($login['USER_ID']);
					return $login;
				}
				else {
					// user has entered login info wrong too many times.
					return false;
				}
			}
		}
		
		// no record was found. Probably should increment login attempts based on ip...
		else {
			return false;
		}
		
	}
	
	/*
	 * Returns false if counter is at or above 5, else returns true and increments
	 * the invalid login in the user table.
	 */
		private function incrementInvalidLogin($userId, $invalidCount) {
		
		if ($invalidCount >= 5) {
			return false;
		}
		
		$invalidCount++;
		
		$data = array(
			'invalid_login' => $invalidCount
			);
		$this->db->where('user_id', $userId);
		$this->db->update('user', $data);
		
		return true;
	}
	
	private function resetLoginCount($userId) {
		$data = array(
			'invalid_login' => 0
			);
		$this->db->where('user_id', $userId);
		$this->db->update('user', $data);
		
		return true;

	}

}
?>