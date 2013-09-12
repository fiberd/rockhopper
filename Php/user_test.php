<?php

include '../../inc/k0m3kt.php';
include 'user.php';

echo '<html>';
echo '<body>';

/*
 * Class User
 * 
 * public functions
 * ================
 * 
 * getId()  
 * getUsername()        
 * getFullname() 
 * getPassword()  
 * getEmail()  
 * getType()      
 * getStatus()    
 * getTimezone()   
 * getLocation()    
 * getIconUrl()     
 * getEnabled()  
 * 
 * setDbHandle($dbh)   
 * setUsername($u)      
 * setFullname($f)      
 * setPassword($p)       
 * setEmail($e)          
 * setType($t)           
 * setStatus($s)         
 * setTimezone($z)       
 * setLocation($l)       
 * setIconUrl($i)        
 * setEnabled($b)        
 * 
 * 
 * public static functions
 * =======================
 * 
 * getUser($dbh, $username, $passwd) 
 * getAllUsers($dbh)
 * addUser($dbh, $username, $fullname, $passwd, $email, $timezone) 
 * addUserFull($dbh, $username, $fullname, $passwd, $email, $timezone, $type, $status, $location, $iconurl) 
 * removeUser($dbh, $username) 
 * removeAllUsers($dbh)
 * 
*/

function printUserTable() {
	global $dbh;
	$users = User::getAllUsers($dbh);
	//var_dump($users);
	foreach($users as $user) {
		echo "<p>" . $user . "</p>";
	}
}

echo "<p><b>User table in the begining:</b></p>";
printUserTable();

echo "<p><b>User table after truncation (should be empty):</b></p>";
User::removeAllUsers($dbh);
printUserTable();

echo "<p><b>User table after adding user 1:</b></p>";
User::addUser($dbh, "user1", "user one", "pass1", "user1@mail.com", -6);
printUserTable();

echo "<p><b>User table after adding user 2 and 3:</b></p>";
User::addUser($dbh, "user2", "user two", "pass2", "user2@mail.com", 0);
User::addUserFull($dbh, "user3", "user san", "pass3", "user3@mail.com", 8, 0, 0, "Beijing", "img/user3.jpg");
printUserTable();

echo "<p><b>User 1 info:</b></p>";
$username = 'user1';
$passwd = 'pass1';
$user = User::getUser($dbh, $username, $passwd);
echo "<p>" . $user . "</p>";

echo "<p><b>User 1 after full name and type change:</b></p>";
$user->setFullname("user uno");
$user->setType(User::TYPE_RH_ADMIN);
$user->setStatus(User::STATUS_WORKING);
echo "<p>" . $user;

echo "<p><b>User table after user2 removed:</b></p>";
User::removeUser($dbh, 'user2');
printUserTable();

echo '</body>';
echo '</html>';

