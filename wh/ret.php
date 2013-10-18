<?php

 require_once 'dal.php';
 
 require "Lib/Services/Twilio.php";

$id= $_GET['id'];

 //* Set our AccountSid and AuthToken */
$sid = "AC504f21f97e022508e54d0299d282b1eb";
$token = "7c2898cd13ca9b8f21a84b54c44f1f5a";

/* Outgoing Caller ID you have previously validated with Twilio */
$CallerID = '+972 54-544-2258';

/* Instantiate a new Twilio Rest Client */
$client = new Services_Twilio($sid, $token);

$user_req = Req::first($id);




$number = $user_req->caller; //"+972545442258";
 

$call = $client->account->calls->create(
            $CallerID,                                 // Caller ID
            $number,                                                // Your friend's number
            "http://54.204.1.217/wh/answer.php?id=$id"    // Location of your TwiML
        );
        echo "Started call: $call->sid\n";
 
 
 ?>