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

    public function getList()
    {
        return new JsonModel([
            'getlist'
        ]);
    }

    public function get($id)
    {
        return new JsonModel([
            __METHOD__
        ]);
    }

    public function create($data)
    {
        if (! isset($data['email']) or empty($data['email'])) {
            
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            return new JsonModel([
                'message' => 'Email is required'
            ]);
        }
        
        if (! isset($data['password'])or empty($data['password'])) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            return new JsonModel([
                'message' => 'Password is required'
            ]);
        }
        $email = $data['email'];
        $password = $data['password'];
        
        $this->userModel->save($email, $password);
        
        return new JsonModel([
            'message' => 'User saved successfully'
        ]);
    }
}

