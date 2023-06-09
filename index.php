<?php 
//function for read txt file
function readTextFile() {
    // Opens file in read-only mode
    $file = fopen(__DIR__ . '/public/raw_data.txt', 'r');
    //if file not found will be return
    if (!$file) {
        return;
    } 
    while (($line = fgets($file)) !== false) {
        yield $line; //fgets read line by line
    }

    fclose($file);
};

//function for write file
function writeTextFile(){
// Opens file in write-only mode
$newfile = fopen(__DIR__ . '/public/format_data.txt', "w") or die("Unable to open file!");
foreach (readTextFile() as $value) {
    // prepare TA data
    $arrayTA = explode('TA', $value);
    $getTA = substr(explode('}' , $arrayTA[1])[0], 1);
    // prepare UA data
    $arrayUA = explode('UA', $value);
    $getUA = substr(explode('}' , $arrayUA[1])[0],1);
    // Write file TA and UA to new file
    fwrite($newfile, $getTA.";".$getUA);
}

fclose($newfile);
}
// Call function
writeTextFile();
?>