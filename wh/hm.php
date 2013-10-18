<?php
    header("content-type: text/xml");
   echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<!-- <Response>
    <Say>Ok Yahoo - What would you like to do</Say>
    <Record transcribe="true" transcribeCallback="transcribed.php"
        action="goodbye.php" maxLength="30" />
</Response> -->

<Response>
    <Gather action="handle_user_input.php" numDigits="1">
        <Say>OK Yahoo</Say>
        <Say>For Wather press 1.</Say>
        <Say>For Stocks, press 2.</Say>
        <Say>For Answers, press 3.</Say>
    </Gather>
    <!-- If customer doesn't input anything, prompt and try again. -->
    <Say>Sorry, I didn't get your response.</Say>
    <Redirect>hm.php</Redirect>
</Response>