<?php

namespace App\Tests\Feature\Config;

class AuthConfig {
    const ADMIN_HEADERS = [
        'Authorization' => 'Basic YWRtaW46YWRtaW4xMjM=',
    ];
    
    const PUBLIC_HEADERS = [
        'Authorization' => 'Basic cmVnaXN0ZXJlZF8xOnRlc3QxMjM0',
    ];
}
