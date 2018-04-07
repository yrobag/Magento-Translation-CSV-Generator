<?php

$shortOpt ='';
$longOpt = [];
$shortOpt .= 'p:';$longOpt[]='path:';
$shortOpt .= 'f:';$longOpt[]='file:';

$options = getopt($shortOpt, $longOpt);

if(isset($options['path'])){
    $path = $options['path'];
}elseif(isset($options['p'])){
    $path = $options['p'];
}else{
    $path = '.';
}

if(isset($options['file'])){
    $fileToSave = $options['file'];
}elseif(isset($options['f'])){
    $fileToSave = $options['f'];
}else{
    $fileToSave = 'translations.csv';
}


$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

$toTranslate = [];

foreach ($files as $file) {

    if ($file->isDir()){
        continue;
    }
    $path = $file->getPathname();
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if(in_array($ext, ['php', 'phtml'])){
        $value = file_get_contents($path);
        preg_match_all('/__\(("|\')(.*?)("|\')/',$value, $result);
        if(isset($result[2]) && is_array($result[3])){
            foreach($result[2] as $match){
                $toTranslate[] = $match;
            }
        }

    }
}
$toTranslate = array_unique($toTranslate);

$csvContent ='';
foreach($toTranslate as $phrase){
    $csvContent .= "\"$phrase\",\"$phrase\"\n";
}

file_put_contents($fileToSave, $csvContent);




