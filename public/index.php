<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;

$routes = new RouteCollection();

$routes->add('AddGenre', new Route('admin/genres/add', ['_controller' => '\Controllers\GenreController', '_method' => 'add']));
$routes->add('ListGenre', new Route('admin/genres/', ['_controller' => '\Controllers\GenreController', '_method' => 'showAll']));
$routes->add('PageGenre', new Route('admin/genres/{id}', ['_controller' => '\Controllers\GenreController', '_method' => 'showOne']));

$routes->add('AddPerson', new Route('admin/people/add', ['_controller' => '\Controllers\PersonController', '_method' => 'add']));
$routes->add('ListPerson', new Route('admin/people/', ['_controller' => '\Controllers\PersonController', '_method' => 'showAll']));
$routes->add('PagePerson', new Route('admin/people/{id}', ['_controller' => '\Controllers\PersonController', '_method' => 'showOneAdmin']));
$routes->add('PagePerson1', new Route('/people/{id}', ['_controller' => '\Controllers\PersonController', '_method' => 'showOne']));

$routes->add('AddProfession', new Route('admin/professions/add', ['_controller' => '\Controllers\ProfessionController', '_method' => 'add']));
$routes->add('ListProfession', new Route('admin/professions/', ['_controller' => '\Controllers\ProfessionController', '_method' => 'showAll']));
$routes->add('PageProfession', new Route('admin/professions/{id}', ['_controller' => '\Controllers\ProfessionController', '_method' => 'showOne']));

$routes->add('PageSearch', new Route('/search/', ['_controller' => '\Controllers\SearchController', '_method' => 'search']));
$routes->add('PageHome', new Route('/home/', ['_controller' => '\Controllers\SearchController', '_method' => 'home']));



$routes->add('AddCountry', new Route('admin/countries/add', ['_controller' => '\Controllers\CountryController', '_method' => 'add']));
$routes->add('ListCountry', new Route('admin/countries/', ['_controller' => '\Controllers\CountryController', '_method' => 'showAll']));
$routes->add('PageCountry', new Route('admin/countries/{id}', ['_controller' => '\Controllers\CountryController', '_method' => 'showOne']));

$routes->add('AddEntity', new Route('admin/entities/add', ['_controller' => '\Controllers\EntityController', '_method' => 'add']));
$routes->add('ListEntity', new Route('/entities/', ['_controller' => '\Controllers\EntityController', '_method' => 'showAll']));
$routes->add('PageEntity', new Route('admin/entities/{id}', ['_controller' => '\Controllers\EntityController', '_method' => 'showOneAdmin']));
$routes->add('EditEntity', new Route('admin/entities/{id}/edit', ['_controller' => '\Controllers\EntityController', '_method' => 'update']));
$routes->add('PageEntityShow', new Route('/entities/{id}', ['_controller' => '\Controllers\EntityController', '_method' => 'showOne']));

$routes->add('ListReview', new Route('/entities/{id}/reviews', ['_controller' => '\Controllers\EntityController', '_method' => 'showReviews']));
########$routes->add('PageReview', new Route('/entities/{id}/reviews/{review_id}', ['_controller' => '\Controllers\EntityController', '_method' => 'showReviews']));
$routes->add('AddReview', new Route('/entities/{id}/reviews/add', ['_controller' => '\Controllers\EntityController', '_method' => 'createReview']));


$routes->add('AddTag', new Route('admin/tags/add', ['_controller' => '\Controllers\TagController', '_method' => 'add']));

$routes->add('Logout', new Route('/logout/', ['_controller' => '\Controllers\UserController', '_method' => 'user_logout']));
$routes->add('Login', new Route('/login/', ['_controller' => '\Controllers\UserController', '_method' => 'user_login']));
$routes->add('EditUser', new Route('users/{id}/edit', ['_controller' => '\Controllers\UserController', '_method' => 'user_update']));
$routes->add('PageUser', new Route('/users/{id}', ['_controller' => '\Controllers\UserController', '_method' => 'showOne']));
$routes->add('ListReviewUser', new Route('/users/{id}/reviews/', ['_controller' => '\Controllers\UserController', '_method' => 'showAllReviews']));
#$routes->add('PageUser', new Route('/users/{id}/reviews/{review}', ['_controller' => '\Controllers\UserController', '_method' => 'showOne']));
$routes->add('EditReviewUser', new Route('/users/{id}/reviews/{reviewid}/edit', ['_controller' => '\Controllers\UserController', '_method' => 'editReview']));


$routes->add('Registration', new Route('/registration', ['_controller' => '\Controllers\UserController', '_method' => 'user_register']));


// Create a request context
$context = new RequestContext();

// Create a Symfony Request object
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

// Set the request context
$context->fromRequest($request);

// Create a URL matcher
$matcher = new UrlMatcher($routes, $context);
try {
    // Match the current request
    $parameters = $matcher->match($request->getPathInfo());
    
    // Debugging: Dump the parameters array to inspect its contents
   # var_dump($parameters["id"]);
    
    // Filter out named parameters starting with an underscore
    $routeParameters = array_filter($parameters, function ($key) {
        return strpos($key, '_') !== 0;
    }, ARRAY_FILTER_USE_KEY);
    
    // Extract controller and method names from the filtered parameters
    $controllerName = $parameters['_controller'];
    $methodName = $parameters['_method'];

    // Resolve the controller class name
    $controllerClass = ltrim($controllerName, '\\');

    // Check if the controller class exists
    if (!class_exists($controllerClass)) {
        throw new \Exception('Controller class not found: ' . $controllerClass);
    }

    // Instantiate the controller class
    $controller = new $controllerClass();

    // Call the specified method with route parameters
    call_user_func_array([$controller, $methodName], $routeParameters);
} catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
    echo '404 Not Found';
} catch (\Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}