<?php
	session_start();
	// constants
	include('DB/constants.php');
	include('DB/_cipher.php');
	$cipher = new Cipher( $_COOKIE["_coid"] );

	function last($a, $b) {
	  if (strtotime($a) > strtotime($b))
		return $a;
	  else
		return $b;
	}

	include "get_Reservations.php";

	$midnight_lastnight = new DateTime('yesterday');
	$midnight_lastnight = $midnight_lastnight->format('Y-m-d 00:00:00');
	echo "midnight lastnight: " . $midnight_lastnight . "<br>";

	$midnight_tonight = date('Y-m-d 00:00:00');
	echo "midnight tonight: " . $midnight_tonight . "<br>";

	$yesterday = new DateTime('yesterday');
	$yesterday = $yesterday->format('Y-m-d 15:30:00');

	echo "yesterday: " . $yesterday . "<br>";

	$now = date('Y-m-d h:i:s');
	echo "now: " . $now . "<br>";

	$today = new DateTime('today');
	$today = $today->format('Y-m-d 15:30:00');
	echo "today: " . $today . "<br>";

	$tomorrow = new DateTime('tomorrow');
	$tomorrow = $tomorrow->format('Y-m-d 04:30:00');
	echo "tomorrow: " . $tomorrow . "<br>";

	$str = null;
	if($midnight_tonight > $now){
		if($yesterday < $midnight_tonight){
			$start_date = new DateTime('yesterday');
			$start_date = $start_date->format('Y-m-d 15:30:00');
			$str .= $start_date . " - ";
			$end_date = new DateTime('today');
			$end_date = $end_date->format('Y-m-d 04:30:00');
			$str .= $end_date;
		}
	}elseif($midnight_lastnight < $now){
		if($today > $midnight_lastnight){
			$start_date = new DateTime('today');
			$start_date = $start_date->format('Y-m-d 15:30:00');
			$str .= $start_date . " - ";
			$end_date = new DateTime('tomorrow');
			$end_date = $end_date->format('Y-m-d 04:30:00');
			$str .= $end_date;
		}
	}

	echo "results for: " . $str . "<br>";

	$venue_id = $cipher->decrypt($_COOKIE["_vuid"]);
	echo "venue_id: " . $venue_id . "<br>";
	$results = get_Reservations( $venue_id, $start_date, $end_date );

	echo "<pre>";
	print_r($results);
	echo "</pre><br>";
