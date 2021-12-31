<?php

namespace Espo\MyModule\Controllers;

use Espo\Core\Api\Request;
use Espo\Core\Api\Response;

use Espo\ORM\EntityManager;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\Log;
use Espo\Core\Utils\Json;
use Espo\MyModule\Core\Utils\Cisco\Cisco;

use stdClass;

class GlobalController
{
    private $config;
    private $em;
    private $log;

    public function __construct(Config $config, EntityManager $entityManager, Log $log)
    {
        $this->config = $config;
        $this->em = $entityManager;
        $this->log = $log;
    }

    public function postActionCiscoExecute(Request $request, Response $response): array
    {
        $data = $request->getParsedBody();
        $extension = preg_replace('/\D/', '', $data->extension);
        $phoneNumber = preg_replace('/\D/', '', $data->phoneNumber);

        return Cisco::CiscoExecute($extension, $phoneNumber);
    }
}