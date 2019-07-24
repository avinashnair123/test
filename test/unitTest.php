<?php
include_once('./models/UserModel.php');

use PHPUnit\Framework\TestCase;

class unitTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->model = new UserModel();
    }
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @covers models/UserModel::checkExisitingUser
     */
    public function testCheckExisitingUser()
    {
        $email = 'test123@gmail.com';
        $result = $this->model->checkExisitingUser($email);
       
        $this->assertFalse($result);
    }

    /**
     * @test
     * @covers models/UserModel::getUser
     */
    public function testGetUser()
    {
        $result = $this->model->getUser();
       
        $this->assertNotEmpty($result);
    }
}