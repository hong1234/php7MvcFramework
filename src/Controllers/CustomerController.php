<?php

namespace Diva\Controllers;

use Bookstore\Exceptions\NotFoundException;

use Diva\Core\Request;
use Diva\Utils\DependencyInjector;
use Diva\Repository\UserRepository;

class CustomerController extends AbstractController {

    protected $repo;

    function __construct(DependencyInjector $di, Request $request){
        parent::__construct($di, $request);
        $this->repo = new UserRepository($this->db);
    }

    public function login(): string {

        if (!$this->request->isPost()) {
            return $this->render('login.twig', []);
        }

        $params = $this->request->getParams();

        if (!$params->has('email')) {
            $params = ['errorMessage' => 'No info provided.'];
            return $this->render('login.twig', $params);
        }

        $email = $params->getString('email');

        try {
            $customer = $this->depo->getByEmail($email);
        } catch (NotFoundException $e) {
            $this->log->warn('Customer email not found: ' . $email);
            $params = ['errorMessage' => 'Email not found.'];
            return $this->render('login.twig', $params);
        }

        setcookie('user', $customer->getId());

        $newController = new ProductController($this->di, $this->request);
        return $newController->getAll();

    }

}