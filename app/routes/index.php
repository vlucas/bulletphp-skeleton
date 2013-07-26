<?php
// Options from root URL (should expose all available user choices)
$app->path(array('/', 'index'), function($request) use($app) {
    $app->get(function($request) use($app) {
        $data = array(
            'rel' => array('index'),
            'links' => array(
                array(
                    'rel' => array('user_list'),
                    'title' => t('Users'),
                    'href' => $app->url('/users')
                ),
                array(
                    'rel' => array('event_list'),
                    'title' => t('Events'),
                    'href' => $app->url('/events')
                ),
                array(
                    'rel' => array('message_list'),
                    'title' => t('Messages'),
                    'href' => $app->url('/messages')
                )
            )
        );

        $app->format('json', function() use($data) {
            return $data;
        });
        $app->format('html', function() use($app, $data) {
            return $app->template('index', compact('data'));
        });
    });
});

