<?php

use Vita\Booking\Controllers\ApartmentController;

use Vita\Booking\Controllers\BookController;
use Vita\Booking\Controllers\FileController;
use Vita\Booking\Controllers\UserController;
use Vita\Booking\Services\Router;

Router::get('/', ApartmentController::class, 'home');
Router::get('/apartments', ApartmentController::class, 'index');
Router::get('/apartments/{id}', ApartmentController::class, 'show');
Router::get('/apartments/new', ApartmentController::class, 'create');
Router::post('/apartments/new', ApartmentController::class, 'store');
Router::get('/apartments/edit', ApartmentController::class, 'edit');
Router::post('/apartments/edit/delete', ApartmentController::class, 'destroy');
Router::get('/apartments/edit/{id}', ApartmentController::class, 'change');
Router::post('/apartments/edit/{id}/update', ApartmentController::class, 'update');
Router::get('/apartments/edit/{id}/update', ApartmentController::class, 'update');
Router::post('/apartments/availabledates', BookController::class, 'checkDatesByCity');
Router::get('/apartments/{id}/book/{startdate}/{enddate}', BookController::class, 'show');
Router::get('/apartments/{id}/book', BookController::class, 'showOne');
Router::post('/apartments/{id}/book', BookController::class, 'showOne');
Router::get('/apartments/{id}/book/confirm', BookController::class, 'book');
Router::post('/apartments/{id}/book/confirm', BookController::class, 'book');

Router::get('/register', UserController::class, 'createRegister');
Router::get('/login', UserController::class, 'createLogin');

Router::post('/login', UserController::class, 'register');
Router::post('/login/user', UserController::class, 'login');
Router::get('/logout', UserController::class, 'logout');


