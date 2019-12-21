<?php declare(strict_types=1);


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', 'ViewController@list');
    $r->get('/admin', 'ViewController@admin');
    $r->get('/post/{postId:\d+}', 'ViewController@singlePost');
    $r->post('/addpost', 'PostController@addPost');
    $r->post('/post/{postId:\d+}/addcomment', 'CommentController@addComment');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
    	echo "404";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo "405";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controller = explode('@', $handler);
       	$class = $controller[0];
       	$method = $controller[1];

       	$classname = "App\Controllers\\".$class;
       	$classname::$method($vars);
       
        break;
}
