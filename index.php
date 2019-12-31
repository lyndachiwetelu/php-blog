<?php

require_once 'vendor/autoload.php';
require_once 'settings.php';

//Database
use App\Services\Database;
new Database;

require_once 'bootstrap.php';
require_once 'routes.php';
