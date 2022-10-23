<?php

use Vita\Booking\Controllers\ApartmentController;

use Vita\Booking\Controllers\BookController;
use Vita\Booking\Controllers\FileController;
use Vita\Booking\Services\Router;

Router::get('/', ApartmentController::class, 'home');
Router::get('/apartments', ApartmentController::class, 'index');
Router::get('/apartments/{id}', ApartmentController::class, 'show');
Router::get('/apartments/new', ApartmentController::class, 'create');
Router::post('/apartments/new/image', ApartmentController::class, 'store');
Router::get('/apartments/new/image', FileController::class, 'newImage');
Router::post('/apartments/availabledates', ApartmentController::class, 'checkDates');
Router::post('/apartments/availablebycity', ApartmentController::class, 'checkCity');
Router::get('/apartments/{id}/book', BookController::class, 'show');
Router::post('/apartments/{id}/book', BookController::class, 'show');
Router::post('/apartments/{id}/book/confirm', BookController::class, 'book');
Router::get('/apartments/{id}/book/confirm', BookController::class, 'book');
Router::get('/apartments/edit', ApartmentController::class, 'admin');
Router::post('/apartments/edit/delete', ApartmentController::class, 'delete');
Router::get('/apartments/edit/{id}', ApartmentController::class, 'change');
Router::post('/apartments/edit/{id}/update', ApartmentController::class, 'update');
Router::get('/apartments/edit/{id}/update', ApartmentController::class, 'update');

