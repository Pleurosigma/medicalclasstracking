<?php

        $startTime = "2010-03-01 08:00:00";
        $endTime = "2010-03-01 09:00:00";
    
        $startTime = explode(" ", $startTime);
        $endTime = explode(" ", $endTime);
        $startDate = explode("-", $startTime[0]);
        $startTime = explode(":", $startTime[1]);
        $endTime = explode(":", $endTime[1]);
    
    echo $startDate[0] . ", " . $startDate[1] . ", " . $startDate[2] . "<br>";
    echo $startTime[0] . ", " . $startTime[1] . "<br>";
    echo $endTime[0] . ", " . $endTime[1];

?>