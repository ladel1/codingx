<?php

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ItemControllerTest extends WebTestCase {

    // public function testWorking(){
    //     $this->assertEquals(4,2+2);
    // }

    public function testHomePage(){
        $client = $this->createClient();
        $client->request("GET","/");
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

}