<?php
// Config that gets passed into main Bullet/App instance
return array(
    'env' => getenv('BULLET_ENV') ? getenv('BULLET_ENV') : 'development',
    'template.cfg' => array(
        'path' => __DIR__ . '/templates/',
        'path_layouts' => __DIR__ . '/templates/layout/',
        'auto_layout' => 'application'
    )
);
