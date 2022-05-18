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
    'date_format' => [
        'date' => 'd.m.Y',
        'datetime' => 'd.m.Y H:i',
        'time' => 'H:i',
        'month' => 'm.Y',
    ],

    'form_request' => [
        'file' => [
            'max' => [
                'default' => 1024,
            ],
            'mimes' => $formRequestFileMimes,
        ],
    ],
];
