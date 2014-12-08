<?php
			include 'database.php';
			//quick validation
			if (isset ( $_GET ['visitID'] ) && is_numeric ( $_GET ['visitID'] )) {
				$visitid = $_GET ['visitID'];
				// visit info
				$sql = "SELECT * from visit where Visit_ID = ?";
				$visit = excuteQuery ( $sql, [ 
						$visitid 
				] );
				//patient info
				$sql = "SELECT * from patient where PATIENT_ID = ?";
				$patient = excuteQuery ( $sql, [ 
						$visit [0] ['PATIENT_ID'] 
				] );
				$code=$visit [0] ['CODE'] ;
				
				
				//queue info
				$sql = "SELECT * from queue where queue_name = ?";
				$queuecontent = excuteQuery ( $sql, [ 
						$code
				] );
				
				// create Queue
				$queue = new SplQueue ();
				$count = 0;
				$found=false;
										
				//makes sure there is a queue
				if (isset ( $queuecontent [0] ['QUEUE_CONTENT'] )) {
					$queue->unserialize ( $queuecontent[0][QUEUE_CONTENT] );
						// gets the number of people ahead of requested user  in their codes queue
						foreach ($queue as $value )
						{
						if ($value == $visitid) {
							$found=true;
							break;
						}
						$count ++;
					}
				}
				else{
				$count=0;
				}
				
				// cycles of 10, its odd
				$cycles=$count/(6-$code)+1;
				
				$queues = [ ];
				
				// gets the amount of people ahead of users in other queues
			for ($i=1;$i<6;)
				{
					
					if ($i != $code) {


						$queuecontent = excuteQuery($sql, [$i]);

						$queue = new SplQueue ();
						
						if (isset ( $queuecontent [0] ['QUEUE_CONTENT'] )) {
							$queue->unserialize ( $queuecontent [0] ['QUEUE_CONTENT'] );
							$tmp = $queue->count ();
							
							// if there are fewer patients in this queue than maximum amount of 
							// of possible patients  (cycle * number of patients per cycles)
							// or if its code one in which case all patients go in ahead of user
							if($tmp<$cycles*(6-$i)||$i==1){
							
							
							// add all patients from queue to list of people before
							$queues[$i]=$tmp;	
							}
							else{
							// add the proper amount of patients a head of user
							// (number of patients per cycle * cycles)
							$queues[$i]=$tmp/(6-$i)*$cycles;

							
							}
				
						}
						else{
						$queues[$i]=0;
						}
					}
					$i=$i+1;
					
					
				}				
				// to find out the two codes of the people afterwards

				switch  ($code){
				
				case 1:
				$queues[6]= 23;

				break;
				
				case 2:
					
					$queues[6]= 24;

				break;
				
				case 3:
				$queues[6]= 25;

				break;
				
				case 4:
				$queues[6]= 23;
				break;
				
				case 5:
				$queues[6]= 23;
				
				break;
				}
				
				
				// finally adds the number of patients before user in their queue a head of them
				$queues[$code]=$count;
				
				/**
					if wait time is zero 
				*/
				if(!$found){
				$queues[1]=0;
				$queues[2]=0;
				$queues[3]=0;
				$queues[4]=0;
				$queues[5]=0;
				
				}
				
				// tmp values just to get results until stuff gets put into db
			/*	$queues[1]=3;
				$queues[2]=55;
				$queues[3]=55;
				$queues[4]=9;
				$queues[5]=63;
				*/
				if(isset($visit [0])){
				// create JSON DATA
				$json = [ 
						$visit [0],
						$patient [0],
						$queues
				];
				
				//prints it
				echo json_encode ( $json );
			} 
			else {
				// if improper input
				echo 'Visit Does not exist';
			}
			}
			

			else {
				// if improper input
				echo 'ERROR, please provide a valid visit id';
			}

			?>