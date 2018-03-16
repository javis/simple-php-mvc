<?php
/**
 * @var Phroute\Phroute\RouteCollector $router
 */

// List all books
$router->get('/',['App\Controllers\BooksController','index']);
// removes one book
$router->get('books/{id}/delete',['App\Controllers\BooksController','delete']);
// show books creation form
$router->get('books/add',['App\Controllers\BooksController','create']);
// stores book info on DB
$router->post('books/add',['App\Controllers\BooksController','store']);
// show books
$router->get('books/{id}',['App\Controllers\BooksController','view']);
// stores book info on DB
$router->post('books/{id}',['App\Controllers\BooksController','store']);

// authors
$router->get('authors.json',['App\Controllers\AuthorsController','index']);
