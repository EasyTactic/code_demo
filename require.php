<?php

require 'config.php';

require 'db/repository/RepositoryInterface.php';
require 'db/connection/BDConnectionInterface.php';

require 'components/models/User.php';
require 'components/controllers/UserController.php';

require 'db/connection/JSONConnection.php';
require 'db/repository/JSONLowLoadRepository.php';

require 'db/connection/MySQLConnection.php';
require 'db/repository/MySQLRepository.php';

require 'RequestHandlers/RequestHandlerFacade.php';
require 'RequestHandlers/Console.php';
require 'RequestHandlers/Route.php';

require 'db/Connection.php';