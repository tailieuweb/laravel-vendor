<?php

$pages = [
    'http://tailieuweb.local.com/',
    
];

foreach ($pages as $page) {
    file_get_contents($page);
}