<?php
set_time_limit(0); // It will take time, about 10 minutes for all.
require_once(getcwd() . "/backend/class/base.php");

// Autoload all.
$backend = scandir(getcwd() . "/backend/");
array_shift($backend);
array_shift($backend);
foreach ($backend as $dir) {
    $files = scandir(getcwd() . "/backend/{$dir}");
    array_shift($files);
    array_shift($files);

    foreach ($files as $file) {
        require_once(getcwd() . "/backend/{$dir}/{$file}");
    }
}

$base  = new Base();
$base->execute();




// 

// $urlParts = array(
//     'size'       => 12800,
//     'minprofit'  => 5000000,
//     'age'        => 24,
//     'limit'      => 1,
//     'qtype'      => 'Regions',
//     'newsearch'  => 1,
//     'set'        => 1,
//     'prefer_sec' => 1,
//     'sort'       => 'profit',
// );

// $baseUrl = 'https://eve-central.com/home/tradefind_display.html';



// foreach ($regions as $keyFrom => $regionFrom) {
//     foreach ($regions as $keyTo => $regionTo) {
//         $href = $urlParts;
//         $href['fromt'] = $keyFrom;
//         $href['to'] = $keyTo;
//         $url = $baseUrl . "?" . http_build_query($href);

//         if (!strpos(strip_tags(file_get_contents($url)), "Found 0 possible routes")) {
//             $href['limit'] = 50;
//             $url = $baseUrl . "?" . http_build_query($href);
            
//             echo "<a target='_blank' href='{$url}'>{$regionFrom} - {$regionTo}</a><br>";
//         }
//     }
// }
