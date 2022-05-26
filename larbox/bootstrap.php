<?php

$files = glob(__DIR__ . '/bootstrap/*.php');

foreach ($files as $file) {
    require($file);   
}
