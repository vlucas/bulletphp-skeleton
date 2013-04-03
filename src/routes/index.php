<?php
// Options from root URL (should expose all available user choices)
$app->path(array('/', 'index'), function($request) use($app) {
    $app->get(function($request) use($app) {
        $data = array(
            'class' => array('index'),
            'rel' => array('church_list'),
            'actions' => array(
                array(
                    'name' => 'church_geosearch',
                    'rel' => array('geosearch', 'search'),
                    'title' => t('Churches Nearby'),
                    'method' => 'GET',
                    'href' => $app->url('/churches'),
                    'fields' => array(
                        array('name' => 'lat', 'type' => 'float'),
                        array('name' => 'lng', 'type' => 'float')
                    )
                )
            ),
            'links' => array(
                array(
                    'rel' => array('church_list'),
                    'title' => t('Churches'),
                    'href' => $app->url('/churches')
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

