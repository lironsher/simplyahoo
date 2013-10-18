<!DOCTYPE html>

<?php
include_once 'wh/dal.php';  
?>

<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    </head>
    <body>

        <table border="1">
        <tr>
        <th>Id</th>
        <th>Caller</th>
        <th>Text</th>
        <th>Digit</th>
        <th>Answer</th>
        <th>Recording</th>
        <th>Created</th>
        <th>Ans</th>
        </tr>
        <?php
        try
        {
            $result = Req::find("all",array('order' => 'id desc'));
        } catch(Exception $ex)
        {
            echo "Error:$ex";
        }

        // print_r($result);
        $i = 0;
        foreach ($result as $value)
        {
            $id = $value -> id;
            $caller = $value -> caller;
            $text = $value -> text;
            $digit = $value -> digit;
            $answer = $value -> answer;
            $recording_url = $value-> recording_url;
            $published_date = $value -> created_at;
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$caller</td>";
            echo "<td>$text</td>";
            echo "<td>$digit</td>";
            echo "<td>$answer</td>";
            echo "<td><a target='_blank' href='$recording_url'>play</a></td>";
            echo "<td>$published_date</td>";
            echo "<td><a href='wh/ret.php?id=$id'>ans</a></td>";
            echo "</tr>";
        }
    ?>
</table>