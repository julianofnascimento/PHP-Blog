<?php


namespace User\Controller;


use User\Form\LoginForm;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    private $authService;

    public function __construct(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function loginAction()
    {
        if($this->authService->hasIdentity()){
            return $this->redirect()->toRoute('post');
        }
        $form = new LoginForm();
        $messageError = null;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $formData = $form->getData();
                /** @var CallbackCheckAdapter $authAdapter */
                $authAdapter = $this->authService->getAdapter();
                $authAdapter->setIdentity($formData['username']);
                $authAdapter->setCredential($formData['password']);

                $result = $this->authService->authenticate();
                if($result->isValid()) {
                    return $this->redirect()->toRoute('post');
                }else{
                    $messageError = "Login Inválido";
                }
            }
        }
        return new ViewModel([
            'form' => new LoginForm(),
            'messageError' => $messageError
        ]);
    }

    public function logoutAction()
    {
        return new ViewModel();
    }
}