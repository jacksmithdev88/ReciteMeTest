<?php

Route::set('home', function () {
    IndexController::loadData('merry christmas');
    IndexController::create('index.php');
});

Route::set('search', function () {
    IndexController::searchData();
    IndexController::create('index.php');
});
