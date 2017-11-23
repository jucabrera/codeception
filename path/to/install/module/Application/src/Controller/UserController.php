<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Application\Model\UserModel;
use Zend\Http\Response;

class UserController extends AbstractRestfulController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function create($data)
    {
        if (! isset($data['email']) or empty($data['email'])) {            
            $this->getResponse()->setStatusCode(400);
            return new JsonModel([
                'message' => 'Email is required'
            ]);
        }        
        if (! isset($data['password']) or empty($data['password'])) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            return new JsonModel([
                'message' => 'Password is required'
            ]);
        }
        $email = $data['email'];
        $password = $data['password'];        
        try {
            $this->userModel->save($email, $password);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            return new JsonModel([
                'message' => $e->getMessage()
            ]);
        }
        return new JsonModel([
            'message' => 'User saved successfully'
        ]);
    }
}

