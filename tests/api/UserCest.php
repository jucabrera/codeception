<?php


class UserCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests
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
        $I->sendPOST('user',['email'=>'email@test.com']);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Password is required"}');
        $I->seeResponseCodeIs(400);
    }
    
    public function tryCreateUserWithSuccess(ApiTester $I)
    {
        $I->wantTo('test create user with success');
        $I->sendPOST('user',['email'=>'email@test.com','password'=>'123']);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"User saved successfully"}');
        $I->seeResponseCodeIs(400);
    }
}
