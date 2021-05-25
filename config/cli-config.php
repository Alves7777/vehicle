<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Adapter\CustomConnection;

include dirname(__DIR__).'/vendor/autoload.php';
include dirname(__DIR__).'/config/database.php';

$entityManager = CustomConnection::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
