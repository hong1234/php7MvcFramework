<?php

namespace Diva\Controllers;

use Diva\Core\Request;
use Diva\Utils\DependencyInjector;

abstract class AbstractController {
    
    protected $request;
    protected $db;
    //protected $config;
    protected $view;
    //protected $log;
    protected $customerId;
    protected $di;

    public function __construct(DependencyInjector $di, Request $request) {
        $this->request = $request;
        $this->di = $di;
        $this->db = $di->get('entityManager');
        //$this->log = $di->get('Logger');
        $this->view = $di->get('twig');
        //$this->config = $di->get('Utils\Config');
    }

    public function setCustomerId(int $customerId) {
        $this->customerId = $customerId;
    }

    protected function render(string $template, array $params): string {
        return $this->view->render($template, [
           'result' => $params
        ]);
    }
}