<?php

$doc = new DOMElement()
$file = "/home2/cryptove/public_html/jobs/index.html";

if ($doc->loadHTMLFile($file)){
    $span = $doc->getElementsByTagName('span')->item(0);
    $count = $span->textContent;
    $count++;

    $doc->getElementsByTagName('span')->item(0)->nodeValue = $count;
    $doc->saveHTMLFile($file);

    echo 'file updated sucessfully';
}
else{
    return false;
}

?>
