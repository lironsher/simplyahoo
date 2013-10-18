<?php
echo "start";
require_once 'dal.php';
$id = $_GET['id'];

$user_req = Req::first($id);

$text = $user_req -> text;
echo ";Text:$text";
require_once 'Lib/yahooanswer.class.php';

$params = array('query' => $text, //enter your keyword here. this will be searched on yahoo answer
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
    print_r($questions);
    
    $answerObj = $questions[0];
    $answer = $answerObj['ChosenAnswer'];
    echo "<br><br>$answer";
    
    
    $user_req->answer=$answer;
    $user_req->save();
    
    

} catch (Exception $e)
{
    echo($e -> getMessage());
}
?>