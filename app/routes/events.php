<?php
use Entity\Event;

/**
 * NOTE: This code IS NOT FUNCTIONAL as-is. It is only here to show what can
 * be done with Bullet routes and to provide pseudo-code on how it can be used.
 */

// PATH /events
$app->path('events', function($request) use($app) {

    // GET (list all events)
    $app->get(function($request) use($app) {

        $items = array(
            array(
                'id' => 1,
                'title' => 'Test Event 1',
                'description' => 'A super cool event',
                'active' => true,
                'date_created' => new \DateTime()
            ),
            array(
                'id' => 2,
                'title' => 'Test Event 2',
                'description' => null,
                'active' => true,
                'date_created' => new \DateTime()
            ),
            array(
                'id' => 3,
                'title' => 'Test Event 3',
                'description' => 'A super cool event',
                'active' => false,
                'date_created' => new \DateTime()
            )
        );

        $app->format('json', function($request) use($app, $items) {
            return $items;
        });
        $app->format('html', function($request) use($app, $items) {
            return $app->template('events/index', compact('items'));
        });
    });

    // POST - New Item
    $app->post(function($request) use($app) {
        // You will probably want to do some basic validaton first...
        $event = new Event($request->post());

        if($event->save()) {
            $response = $app->response(201, $event->toArray());
            $app->format('json', function($request) use($response) {
                return $response;
            });
            $app->format('html', function($request) use($app, $response, $event) {
                return $response->redirect($app->url('./' . $event->id));
            });
        } else {
            $app->format('json', function($request) use($app, $event) {
                // Return errors
                return $app->response(400, $event->errors());
            });
            $app->format('html', function($request) use($app, $event) {
                // Re-display event form and show errors
                return $app->template('events/new', compact('event'))
                  ->status(400);
            });
        }
    });

    // PATH /events/<id>
    $app->param('int', function($request, $id) use($app) {
        // Load single record
        $event = Event::find($id);
        if(!$event) {
            return false;
        }

        // GET
        $app->get(function($request) use($app, $event) {
            $app->format('json', function() use($app, $event) {
                return $event->toArray();
            });
            $app->format('html', function() use($app, $request, $event) {
                return $app->template('events/view', compact('event'));
            });
        });

        // DELETE
        $app->delete(function($request) use($app, $event) {
            $result = Event::delete();
            if($result !== false) {
                return 204;
            }
            return 400;
        });
    });
});
