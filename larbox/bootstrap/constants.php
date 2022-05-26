<?php

// Formats

if (!defined('LARBOX_FORMAT_DATE')) define('LARBOX_FORMAT_DATE', 'd.m.Y');
if (!defined('LARBOX_FORMAT_DATETIME')) define('LARBOX_FORMAT_DATETIME', 'd.m.Y H:i:s');
if (!defined('LARBOX_FORMAT_TIME')) define('LARBOX_FORMAT_TIME', 'H:i:s');

// Tests

if (!defined('LARBOX_TEST_ADMIN_HEADERS')) define('LARBOX_TEST_ADMIN_HEADERS', [
    'Authorization' => 'Basic YWRtaW46YWRtaW4xMjM=',
]);

if (!defined('LARBOX_TEST_PUBLIC_HEADERS')) define('LARBOX_TEST_PUBLIC_HEADERS', [
    'Authorization' => 'Basic cmVnaXN0ZXJlZF8xOnRlc3QxMjM0',
]);

// Validation

$formRequestFileMimes = [
    'image' => 'jpg,png,webp,svg',
    'document' => 'doc,docx,xls,xlsx,pdf',
    'audio' => 'mp3,ogg',
    'video' => 'mp4',
];

$formRequestFileMimesAll = array_values($formRequestFileMimes);
$formRequestFileMimes['all'] = implode(',', $formRequestFileMimesAll);

if (!defined('LARBOX_VALIDATION_FILE_MIMES_IMAGE')) define('LARBOX_VALIDATION_FILE_MIMES_IMAGE', $formRequestFileMimes['image']);
if (!defined('LARBOX_VALIDATION_FILE_MIMES_DOCUMENT')) define('LARBOX_VALIDATION_FILE_MIMES_DOCUMENT', $formRequestFileMimes['document']);
if (!defined('LARBOX_VALIDATION_FILE_MIMES_AUDIO')) define('LARBOX_VALIDATION_FILE_MIMES_AUDIO', $formRequestFileMimes['audio']);
if (!defined('LARBOX_VALIDATION_FILE_MIMES_VIDEO')) define('LARBOX_VALIDATION_FILE_MIMES_VIDEO', $formRequestFileMimes['video']);
if (!defined('LARBOX_VALIDATION_FILE_MIMES_ALL')) define('LARBOX_VALIDATION_FILE_MIMES_ALL', $formRequestFileMimes['all']);

if (!defined('LARBOX_VALIDATION_FILE_SIZE_DEFAULT')) define('LARBOX_VALIDATION_FILE_SIZE_DEFAULT', 102400);
if (!defined('LARBOX_VALIDATION_FILE_SIZE_IMAGE')) define('LARBOX_VALIDATION_FILE_SIZE_IMAGE', 1024);