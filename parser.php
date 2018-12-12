<?php


$db = mysql_connect("localhost", "", "") or die("Could not connect.");

if(!$db) 

	die("no db");


if(!mysql_select_db("project",$db))

 	die("No database selected.");


//read directory
$dht  = '/home/admin/web/website/public_html/data/';
$dh  = opendir('/home/admin/web/website/public_html/data/');
$inserted = 0;
while (false !== ($filename = readdir($dh))) {
   
$tmp = explode('.', $filename);
$ext = end($tmp);



    if($ext !== 'csv'){
        continue;;
    }
    
    $row = 1;
    if (($handle = fopen('/home/admin/web/website/public_html/data/'.$filename, "r")) !== FALSE) {
        $db_rows = array();
        while (($data = fgetcsv($handle, 18000, ",")) !== FALSE) {
if($row == 1){ $row++; continue; }
            $num = count($data);
            $row++;
            if($num==3){
               $sql = "select `device_mac` ,`device_datetime` ,`device_value` from `measurements` where `device_datetime` = '".$data[2]."' ";
                $res = mysql_query($sql) or die(mysql_error());
                if(mysql_num_rows($res)!=0){
                    mysql_free_result($res);
                    continue;
                }
                mysql_free_result($res);




                $db_rows[] = "('".trim($data[0])."','".trim($data[1])."','".trim($data[2])."')";
            }
        }
        fclose($handle);
        
        if(!empty($db_rows)){

            //$db_rows = array_unique($db_rows);
            $inserted += count($db_rows);
            $sql = "INSERT INTO `measurements` (`device_mac` ,`device_datetime` ,`device_value`) values ";
            $sql .= implode(",",$db_rows);
            mysql_query($sql);
					
			
        }
    }
}

 

// delete files after parsing
$dir ='/home/admin/web/website/public_html/data/';
foreach(glob($dir.'*.*') as $v){
unlink($v);}

?>






