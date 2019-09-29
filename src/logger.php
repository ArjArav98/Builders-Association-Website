<?php

/**************/
/* LOGGER.PHP */
/**************/

/* This file contains functions which help with logging files and reading them. */

/*--------------*/
/* FILE WRITING */
/*--------------*/

/* This function logs in when a candidate has been referred. */
function referralLog($candidateName,$companyName,$companyId) {
	$string="<span>[".getCurrentTimestamp()."]</span> $candidateName was referred to $companyName (Company-ID: $companyId).\n";
	$fileData = file_get_contents("../../admin/history/log.txt");
	file_put_contents("../../admin/history/log.txt",$string.$fileData);
}

/* This function logs in when a candidate has been placed. */
function placementLog($candidateName,$companyName,$companyId) {
	$string="<span>[".getCurrentTimestamp()."]</span> $candidateName was placed in $companyName (Company-ID: $companyId).\n";
	$fileData = file_get_contents("../../admin/history/log.txt");
	file_put_contents("../../admin/history/log.txt",$string.$fileData);
}

/* This function logs in when a candidate has been rejected. */
function rejectionLog($candidateName,$companyName,$companyId) {
	$string="<span>[".getCurrentTimestamp()."]</span> $candidateName was rejected by $companyName (Company-ID: $companyId).\n";
	$fileData = file_get_contents("../../admin/history/log.txt");
	file_put_contents("../../admin/history/log.txt",$string.$fileData);
}

/*--------------*/
/* FILE READING */
/*--------------*/

/* Returns the contens of the LOG.TXT file depending upon the paginationNum given. */
function getLoggerContents($paginationNum) {
	$file = fopen("log.txt","r");
	$size = filesize("log.txt");
	$paginationMax = getFilePaginationValue();

	if($paginationNum > $paginationMax) { /* If paginationNum is not valid (too big), then we return an error. */
		return "The end of the history has been reached.";
	}
	else {
		/* We check if the actual size is PageNum or PageNum-1+something. */
		if($paginationNum*5000 <= $size) { /* If PageNum... */
			fseek($file,$paginationNum*5000);
			return fread($file,5000);
		}
		else { /* If PageNum-1+something... */
			fseek($file,($paginationNum-1)*5000);
			return fread($file,$size-(($paginationNum-1)*5000)-1);
		}
	}
}

/* Returns the number of pages that would be needed to display this file in the application. */
function getFilePaginationValue() {
	$size = filesize("log.txt");
	$pages = round($size/5000);
	return ($pages*5000 == $size)? $pages : $pages + 1;
}

/*----------------*/
/* DATES AND TIME */
/*----------------*/

/* Returns the current timestamp of the machine that PHP is running on. */
function getCurrentTimestamp() {
	date_default_timezone_set('Asia/Kolkata'); /* Setting the timezone to Kolkata. */
	$date = new DateTime(); /* We get the time in the form of a UNIX timestamp. */
	return date_format($date, 'Y-m-d H:i:s'); /* It is then formatted. */
}

/*************/
/* SEARCHING */
/*************/

/* This function searches the LOG.TXT file for a specific term and resturns the results. */
function searchHistoryFor($searchTerm) {
	system("grep \"$searchTerm\" ../../admin/history/log.txt > ../../admin/history/searched-log.txt");
	return file_get_contents("../../admin/history/searched-log.txt");
}

?>
