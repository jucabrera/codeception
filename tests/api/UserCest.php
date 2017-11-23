<?php

use Codeception\Util\HttpCode;

class UserCest
{    
    public function tryCreateUserWithoutEmailTest(ApiTester $I)
    {
        $I->wantTo('test create user without email');
        $I->sendPOST('user',['password'=>'123']);        
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Email is required"}');
        $I->seeResponseCodeIs(400);
    }
    
    public function tryCreateUserWithoutPasswordTest(ApiTester $I)
    {
        $I->wantTo('test create user without password');
        $I->sendPOST('user',['email'=>'email@test.com', 'password'=>'']);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"Password is required"}');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
    
    public function tryCreateUserWithSuccess(ApiTester $I)
    {
        $I->wantTo('test create user with success');
        $I->sendPOST('user',['email'=>'email@test.com','password'=>'123']);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"User saved successfully"}');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }
    
    
}
