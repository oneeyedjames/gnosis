<?php

use Bamboo\Router\Router;

use LMS\Controller\CourseController;
use LMS\Controller\ModuleController;
use LMS\Controller\LessonController;

$router = new Router();
$router->registerController(new CourseController());
$router->registerController(new ModuleController());
$router->registerController(new LessonController());
