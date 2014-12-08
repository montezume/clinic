<?php
function excuteQuery($selectQ, $data) {
	try {
		$pdo = new PDO ( 'mysql:dbname=CS1237628;host=waldo2.dawsoncollege.qc.ca',"CS1237628", "inverchu");
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$stmt = $pdo->prepare ( $selectQ );
		
		if ($stmt->execute ( $data )) {
			$queryResults = $stmt->fetchAll ( PDO::FETCH_ASSOC );
			
			return ($queryResults);
		} else {
			echo "failed";
		}
	} catch ( PDOException $e ) {
		echo $e->getMessage ();
	}
	finally 
	
	{
		unset ( $pdo );
	}
}
?>