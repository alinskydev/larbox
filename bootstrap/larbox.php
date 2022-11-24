<?php

/**
 * Constants 
 */

// Formats

if (!defined('LARBOX_FORMAT_DATE')) define('LARBOX_FORMAT_DATE', 'd.m.Y');
if (!defined('LARBOX_FORMAT_DATETIME')) define('LARBOX_FORMAT_DATETIME', 'd.m.Y H:i:s');

// Tests

if (!defined('LARBOX_TEST_ADMIN_HEADERS')) define('LARBOX_TEST_ADMIN_HEADERS', [
    'Authorization' => 'Basic ' . base64_encode('admin:admin123'),
]);

if (!defined('LARBOX_TEST_WEBSITE_HEADERS')) define('LARBOX_TEST_WEBSITE_HEADERS', [
    'Authorization' => 'Basic ' . base64_encode('registered_1:user1234'),
]);
