<?php
/**
* Function for unzipping the content of a zip file
* @author Arnab Chattopadhyay
* @param mixed $s_zip_source
*/
function unzip($s_zip_source='', $s_destinition_folder='') {
    $zip = zip_open($s_zip_source);
    if ($zip) {
        $s_dest_folder = uniqid().time().'/';
        $s_dest_fullpath = $s_destinition_folder.'/'.$s_dest_folder;
        if(!file_exists($s_dest_fullpath)) {
            mkdir($s_dest_fullpath, 0777);
        }
        while ($zip_entry = zip_read($zip)) {
            if (zip_entry_open($zip, $zip_entry, "r")) {
                $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                file_put_contents($s_dest_fullpath.zip_entry_name($zip_entry), "$buf");
                zip_entry_close($zip_entry);
            }
        }
        zip_close($zip);
        return $s_dest_fullpath;
    }
}





