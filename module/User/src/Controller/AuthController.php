<?php


namespace User\Controller;


use User\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        return new ViewModel([
            'form' => new LoginForm()
        ]);
    }

    public function logoutAction()
    {
        return new ViewModel();
    }
}