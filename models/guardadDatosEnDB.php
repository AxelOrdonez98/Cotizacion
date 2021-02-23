<?php
    $sql = "INSERT INTO `quotes`(`id_quote`, `applicant_name`, `applicant_email`, `dependency`, `obra`, `address`, `city`, `date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])";
    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;
        $dbdata["success"] = "New record created successfully";
        $dbdata["lastId"] =  $lastId;
        foreach ($json["servicesArray"] as $key => $array) {
            $date2 = $array["date"];
            $date = date("d/m/y", strtotime($array["date"]));
            $workedHours = $array["workedHours"];
            $arrivalTime = date("h:i A", strtotime($array["arrivalTime"]));
            $startTime = date("h:i A", strtotime($array["startTime"]));
            $endTime = date("h:i A", strtotime($array["endTime"]));
            $machineType = $array["machineType"];
            $sn = $array["sn"];
            $xno = $array["xNo"];
            $mfgDate = $array["mfgDate"];
            $hours = $array["hours"];
            $firmware = $array["firmwareVP"];
            $tarifa = $array["tarifa"];
            $chargeDollars = $array["chargeDollars"];
            $sql2 = "INSERT INTO `services`(`reportId`, `date`, `workedHours`, `arrivalTime`, `startTime`, `endTime`, `machineType`, `sn`,      `xno`, `mfgDate`, `hours`, `firmware`, `tarifa`, `chargeDollars`)
            VALUES ('{$lastId}', '{$date2}', '{$workedHours}', '{$arrivalTime}', '{$startTime}', '{$endTime}', '{$machineType}', '{$sn}', '{$xno}', '{$mfgDate}', '{$hours}', '{$firmware}', '{$tarifa}', '{$chargeDollars}')";

            if ($conn->query($sql2) === TRUE) {
                $dbdata["array".$key.""] = "New record created successfully";
            }else {
                $dbdata["error_array".$key.""] = "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }
?>