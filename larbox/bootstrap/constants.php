<?php

// Formats

if (!defined('LARBOX_FORMAT_DATE')) define('LARBOX_FORMAT_DATE', 'd.m.Y');
if (!defined('LARBOX_FORMAT_DATETIME')) define('LARBOX_FORMAT_DATETIME', 'd.m.Y H:i');
if (!defined('LARBOX_FORMAT_TIME')) define('LARBOX_FORMAT_TIME', 'H:i');

// Tests

if (!defined('LARBOX_TEST_ADMIN_HEADERS')) define('LARBOX_TEST_ADMIN_HEADERS', [
    'Authorization' => 'Basic YWRtaW46YWRtaW4xMjM=',
]);

if (!defined('LARBOX_TEST_PUBLIC_HEADERS')) define('LARBOX_TEST_PUBLIC_HEADERS', [
    'Authorization' => 'Basic cmVnaXN0ZXJlZF8xOnRlc3QxMjM0',
]);
