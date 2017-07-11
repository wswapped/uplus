<?php

include("../db.php");
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$sqlgroups = $db->query("SELECT * FROM groups WHERE 1");
$groups = array();
WHILE($group = mysqli_fetch_array($sqlgroups))
{
    $groups[] = array(
       "adminId"        => $group['adminId'],
       "groupName"      => $group['groupName'],
       "groupDesc"      => $group['groupDesc'],
       "groupStory"     => $group['groupStory'],
       "targetAmount"   => $group['targetAmount'],
       "perPerson"      => $group['perPerson'],
       "expirationDate" => $group['expirationDate'],
       "likes"          => $group['likes'],
       "groupImage"     => 'http://www.uplus.rw/temp/group'.$group['id'].'.jpeg'

    );

}

foreach ($groups as $i => $group) {
$gAdminId = $groups[$i]['adminId'];
    $users = array();
    $sqlusers = $db->query("SELECT * FROM users WHERE id = '$gAdminId'");
    WHILE($user = mysqli_fetch_array($sqlusers))
    {
        $users[] = array(
        	"adminName" => $user['name'],
        	"adminPhone" => $user['phone']
        	 );
    }
    $groups[$i]['groupAdmin'] = $users;
}
unset($groups[$i]['adminId']);

header('Content-Type: application/json');

$groups = json_encode($groups);

echo '{ "groups" : '.$groups.' }';
?>
