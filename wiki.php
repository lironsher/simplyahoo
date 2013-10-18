<?php

function getwiki($title)
{
  
    $url = "http://en.wikipedia.org/w/api.php?action=parse&page=$title&prop=text&section=0&format=json&callback=?";

    $session = curl_init($url);

    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    $json = curl_exec($session);
    echo "$json";
    $phpObj = json_decode($json);

    print_r($phpObj);
}

echo getwiki("demo");

// , function (data) {
// console.log('wiki data', data);
// if (data.error){
// callback('Sorry, Could not find the wikipedia definition of:' + title,phone);
// }else {
// for (text in data.parse.text) {
// $text = data.parse.text[text].split("<p>");
// $pText = "";
// for (p in text) {
//  Remove html comment
// text[p] = text[p].split("<!--");
// if (text[p].length > 1) {
// text[p][0] = text[p][0].split(/\r\n|\r|\n/);
// text[p][0] = text[p][0][0];
// text[p][0] += "</p> ";
// }
// text[p] = text[p][0];

//     Construct a string from paragraphs
// if (text[p].indexOf("</p>") == text[p].length - 5) {
// $htmlStrip = text[p].replace(/<(?:.|\n)*
?>


gm, '') //Remove HTML
                        // $splitNewline = htmlStrip.split(/\r\n|\r|\n/); //Split on newlines
						
                        // for (newline in splitNewline) {
                            // if (splitNewline[newline].substring(0, 11) != "Cite error:") {
                                // pText += splitNewline[newline];
                                // pText += "\n";
                            // }
                        // }
                    // }
                // }

                // pText = pText.substring(0, pText.length - 2); //Remove extra newline
                // pText = pText.replace(/\[\d+\]/g, ""); //Remove reference tags (e.x. [1], [4], etc)
                // textOut = pText.split("\n"); //Remove extra information, save only first paragraph
                // console.log('Got wiki results!');
            // }
        // }
    // })
// };

?>