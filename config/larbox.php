<?php

$formRequestFileMimes = [
    'image' => 'jpg,png,webp,svg',
    'document' => 'doc,docx,xls,xlsx,pdf',
    'audio' => 'mp3,ogg',
    'video' => 'mp4',
];

$formRequestFileMimesAll = array_values($formRequestFileMimes);
$formRequestFileMimes['all'] = implode(',', $formRequestFileMimesAll);

return [
    'form_request' => [
        'file' => [
            'max' => [
                'default' => 1024,
            ],
            'mimes' => $formRequestFileMimes,
        ],
    ],
];
