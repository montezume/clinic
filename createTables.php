<?php

$mysqli = new mysqli("localhost:3306", "root", "");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* check if server is alive */
if ($mysqli->ping()) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", $mysqli->error);
}

$create_table = 
"

CREATE DATABASE IF NOT EXISTS CQS;
USE CQS;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS visit;
DROP TABLE IF EXISTS queue;
DROP TABLE IF EXISTS system;
DROP TABLE IF EXISTS patient;


CREATE TABLE patient 
 (
 PATIENT_ID INT(11) PRIMARY KEY auto_increment,
 RAMQ_ID VARCHAR(255) NOT NULL,
 FIRST_NAME	VARCHAR(255) NOT NULL,
 LAST_NAME VARCHAR(255) NOT NULL,
 HOME_PHONE VARCHAR(12) NOT NULL,
 EMERGENCY_PHONE VARCHAR(12) NOT NULL,
 PRIMARY_PHYSICIAN VARCHAR(255) NOT NULL,
 EXISTING_CONDITIONS TEXT NOT NULL,
 MEDICATION_1 VARCHAR(50) NOT NULL DEFAULT '',
 MEDICATION_2 VARCHAR(50) NOT NULL DEFAULT '',
 MEDICATION_3 VARCHAR(50) NOT NULL DEFAULT ''
 );
 
CREATE TABLE visit 
( 
 VISIT_ID INT(11) PRIMARY KEY auto_increment,
 PATIENT_ID INT(11),
 REGISTRATION_TIME TIMESTAMP DEFAULT NOW(),
 TRIAGE_TIME TIMESTAMP DEFAULT 0,
 EXAMINATION_TIME TIMESTAMP DEFAULT 0,
 CODE INT(1),
 PRIMARY_COMPLAINT VARCHAR(255),
 SYMPTOM_1 VARCHAR(255),
 SYMPTOM_2 VARCHAR(255),
 
 FOREIGN KEY (PATIENT_ID)
	REFERENCES patient(patient_id)
	ON DELETE CASCADE
 );
 
 CREATE TABLE queue 
 (
 QUEUE_ID INT(11) PRIMARY KEY auto_increment,
 QUEUE_NAME VARCHAR(10),
 QUEUE_CONTENT BLOB
 );
 
 CREATE TABLE system
 (
 SYSTEM_ID INT(11) PRIMARY KEY auto_increment,
 CURRENT_POSITION INT(1) not null default 0
 );

 CREATE TABLE user 
 (
 USER_ID INT(11) PRIMARY KEY auto_increment,
 USER_NAME VARCHAR(255) NOT NULL,
 HASHED_PASSWORD VARCHAR(255),
 INVALID_LOGIN INT(1) DEFAULT 0,
 RECEPTION BOOLEAN DEFAULT FALSE,
 TRIAGE BOOLEAN DEFAULT FALSE,
 NURSE BOOLEAN DEFAULT FALSE,
 ADMIN BOOLEAN DEFAULT FALSE
 );
 ";
 
$create_tbl = $mysqli->multi_query($create_table);

if ($create_tbl) {
	echo "Table has created";
	echo $mysqli->error;
}
else {
	echo $mysqli->error;
        echo "error!!";  
}

$mysqli->close();
?>
