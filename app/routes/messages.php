<?php
// PATH /messages
$app->path('messages', function($request) use($app) {

    // GET (list all messages)
    $app->get(function($request) use($app) {

        $items = array(
            array(
                'id' => 1,
                'body' => 'Hello LoneStarPHP!',
                'delivered' => true,
                'date_created' => new \DateTime()
            ),
            array(
                'id' => 2,
                'body' => 'This is a message and here is the message body',
                'delivered' => true,
                'date_created' => new \DateTime()
            ),
            array(
                'id' => 3,
                'body' => 'You haven\'t read this yet',
                'delivered' => false,
                'date_created' => new \DateTime()
            )
        );

        $app->format('json', function($request) use($app, $items) {
            return $items;
        });
        $app->format('html', function($request) use($app, $items) {
            return $app->template('messages/index', compact('items'));
        });
    });
});
