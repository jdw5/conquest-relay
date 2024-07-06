<?php

use function Orchestra\Testbench\workbench_path;

return [
    'share' => true,
    'path' => workbench_path('lang'),
    'languages' => [
        'en' => 'English',
        'es' => 'Español',
    ],
    'excludes' => [
        'validation.php',
    ],
];
