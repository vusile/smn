<?php
return array(
    'host'    => 'localhost',
    'port'    => 9312,
    'timeout' => 30,
    'indexes' => array(
        'songs' => array('table' => 'songs', 'column' => 'id'),
        'composers' => array('table' => 'composers', 'column' => 'id'),
    ),
//    'indexes' => array(
//        'songs' => null,
//        'composers' => null,
//    ),
);
