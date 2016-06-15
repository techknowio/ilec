#!/usr/bin/php
<?php

if ($argc == 2) {
    if ($argv[1] == "config") {
        echo "graph_title ILEC Status\n";
        echo "graph_vlabel Status\n";
        echo "graph_category Power\n";
        echo "graph_info Current Status (higher is worse)\n";
        echo "state.label State\n";
    }
    exit;
}

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://www.ilec.coop/"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch);
curl_close($ch);
if (strstr($output,"PeakDemand05-red.png")) {
    echo "state.value 3\n";    
}
if (strstr($output,"PeakDemand05-yellow.png")) {
    echo "state.value 2\n";    
}
if (strstr($output,"PeakDemand05-green.png")) {
    echo "state.value 1\n";
}
?>
