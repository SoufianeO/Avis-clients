<?php
	function formatDate($date) {
		if(empty($date))
			return "--";
		$parts = explode("-", $date);
		
		$mois=["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Sept","Oct","Nov","Déc"];
		
		$numMois=((int) $parts[1]) -1;

		$date_final = $parts[2]." ".$mois[$numMois]." ".$parts[0];
	
		return $date_final;
	}

	function formatDateTime($dateTime) {
		if(empty($dateTime))
			return "--";
		$parts = explode(" ", $dateTime);
		
		$date = formatDate($parts[0]);

		$parts_time=explode(":", $parts[1]);

		$date_final=$date." ".$parts_time[0].":".$parts_time[1];
	
		return $date_final;
	}
?>