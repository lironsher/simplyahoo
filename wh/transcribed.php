<?php
require_once 'dal.php';
require_once 'weather_a.php';
require_once 'fin.php';
require_once 'ans.php';
// try
// {
    // $req = new Req();  
//    
   // $req->transcription_status = "test";
   // $req->caller = "test";
   // $req->recording_url = "tester";// $_REQUEST['RecordingUrl'];
   // $req->text = "test";// $_REQUEST['TranscriptionText'];
   // $req->save();
// }
// catch (Exception $e)
// {
    // echo "$e";
// }
//    



error_log("Started");
error_log("Started",3,"~root/php.log");

     
    if (!isset($_REQUEST['RecordingUrl'])) {
        echo "Must specify recording url";
        die;
    }
     
    if (!isset($_REQUEST['TranscriptionStatus'])) {
        echo "Must specify transcription status";
        die;
    }
   error_log("With Req",3,"/var/log/php.log");
   
   $req = new Req();  
   $req->transcription_status = strtolower($_REQUEST['TranscriptionStatus']);
   $req->caller = $_REQUEST['Caller'];
   $req->recording_url = $_REQUEST['RecordingUrl'];
   $req->text = $_REQUEST['TranscriptionText'];
   $req->digit = $_REQUEST['digit'];
  
  
  $req->text = str_replace(".", "", $req->text);
//if (($req->digit==2)||($req->digit==5)||($req->text!="(blank)")) 
{
	


switch ($req->digit) 
{
	case 1:
		 $req-> answer = getWeatherForCity($req->text);
		break;
        case 2:
            
            switch (strtolower($req->text)) {
                case 'google':
                    $req-> answer = getStockQuote("GOOG");
                    break;
                    case 'apple':
                    $req-> answer = getStockQuote("AAPL");
                    break;
                    case 'yahoo':
                    $req-> answer = getStockQuote("YHOO");
                    break;
                    case 'facebook':
                    $req-> answer = getStockQuote("FB");
                    break;
                    case 'nice':
                    $req-> answer = getStockQuote("NICE");
                    break;
                
                default:
                    $req-> text .= "Yahoo!";
                    $req-> answer = getStockQuote("YHOO");
                    break;
            }
            
        break;
         case 3:
             $req-> answer = getAnswer($req->text);
             break;
                case 5:
                    $req-> text = "Google";
                    $req-> answer = getStockQuote("GOOG");
                    break;
        
	
	default:
        
require_once 'Lib/yahooanswer.class.php';

$params = array('query' => $req->text, //enter your keyword here. this will be searched on yahoo answer
'results' => 1, //number of questions it should return
'type' => 'resolved', //only resolved questiosn will be returned. other values can be all, open, undecided
'output' => 'php', //result will be PHP array. Other values can be xml, json, rss
);

$yn = new yahooAnswer("dj0yJmk9SXpNbUhVVGFMUXdOJmQ9WVdrOU0xUlNTRzVDTldVbWNHbzlNVGd6T0RReE56VTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0xYw--");
//search questions
try
{

    //f479d43c0178ee812214029661203ec92599a615

    $questions = $yn -> search_questions($params);
    echo "<br>Q";
    //print_r($questions);  
    $answerObj = $questions[0];
    $answer = $answerObj['ChosenAnswer'];
    //echo "<br><br>$answer";
    $req->answer=$answer;

    
} catch (Exception $e)
{
    echo($e -> getMessage());
}
        
		break;
}

}
// else
// {
        // $req->answer = "Cannot be found";
// }





$req->save();

    

require "Lib/Services/Twilio.php";

$id= $req->id;

 //* Set our AccountSid and AuthToken */
$sid = "AC504f21f97e022508e54d0299d282b1eb";
$token = "7c2898cd13ca9b8f21a84b54c44f1f5a";

/* Outgoing Caller ID you have previously validated with Twilio */
$CallerID = '+972 54-544-2258';

/* Instantiate a new Twilio Rest Client */
$client = new Services_Twilio($sid, $token);

$number = $req->caller; //"+972545442258";
 
$call = $client->account->calls->create(
            $CallerID,                                 // Caller ID
            $number,                                                // Your friend's number
            "http://54.204.1.217/wh/answer.php?id=$id"    // Location of your TwiML
        );
        echo "Started call: $call->sid\n";
 
?>