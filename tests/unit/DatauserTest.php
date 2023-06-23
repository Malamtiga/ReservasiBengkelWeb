<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class DatauserTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testlogin(){
        $this->call('post', 'login', [
            'username' => 'bona',
            'password' => '123'
        ])->assertStatus(404);
    }
}