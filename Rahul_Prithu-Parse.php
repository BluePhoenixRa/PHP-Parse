<?php
// Artist List Parser
// Reads file in 'inputFile', parses through ','
// Assigns a value to each artist, compares value
// Returns artists whose names appear in more than 50 lines

$inputFile = "Artist_lists_small.txt";
$readInputFile = file($inputFile);
$outputFile = "Parsed_artist_list.txt";

file_put_contents($outputFile, ''); // Clears output file before each run

$artistArray = array();

foreach ($readInputFile as $eachline){
    $lineNum++;
    $artistName = explode(",", $eachline);
    
    foreach($artistName as $artist){
        if($artistArray[$artist] == null){
            $artistArray[$artist] = array();
        }
        $artistArray[$artist][] = $lineNum;
    }

}

$fileOpen = fopen($outputFile, 'w');
    
foreach ($artistArray as $artistOne => $repeatOne){
    $countOne = count($repeatOne);

    if($countOne >= 50){
        foreach($artistArray as $artistTwo => $repeatTwo){
            $countTwo = count($repeatTwo);

            if($countTwo >= 50 && $artistOne > $artistTwo){
                $matched = count(array_intersect_key($repeatOne, $repeatTwo));

                if($matched >= 50){
                    fwrite($fileOpen, $artistOne." and ".$artistTwo." appears ".$matched." times.\n");
                }
            }
        }
        fwrite($fileOpen, "\n\n");      // Seperates by artistOne
    }

}

fclose($fileOpen);

echo "Output File Created: <a href=".$outputFile.">".$outputFile."</a>"

?>