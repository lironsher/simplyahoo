<?php
    require_once 'dal.php';
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say>
        <?php
         $id = $_GET['id'];

        $user_req = Req::first($id);

        $answer = $user_req->answer;
        $text = $user_req->text;
        echo "OK Yahoo. your answer for $text is:.  $answer";
        ?>
        
        
        
    </Say>
</Response>



<?php
// require_once 'Lib/Services/Twilio.php';
// require_once 'dal.php';
// $response = new Services_Twilio_Twiml();
// $gather = $response->gather(array(
    // 'action' => 'http://example.com/process_poll.php',
    // 'method' => 'GET',
    // 'numDigits' => '1'
// ));
// 
// $id = $_GET['id'];
// 
// $user_req = Req::first($id);
// 
// $answer = $user_req->answer;
// 
// $gather->say("OK Yahoo - your answer is:$answer");
 // $gather->say("If You Would Like Cheese Pizza Press 1");
// // $gather->say("If You Would Like Pepperoni Pizza Press 2");
// // $gather->say("If You Would Like Sausage Pizza Press 3");
// // $gather->say("If You Would Like Pineapple Pizza and Canadian Bacon Press 4");
// 
// header('Content-Type: text/xml');
// print $response;
?>