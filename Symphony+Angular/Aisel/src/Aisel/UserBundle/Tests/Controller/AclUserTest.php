<?php

/*
 * This file is part of the Aisel package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Aisel\UserBundle\Tests\Controller\Admin;

use Aisel\UserBundle\Entity\User;
use Aisel\UserBundle\Tests\UserTestCase;

/**
 * AclUserTest
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class AclUserTest extends UserTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testGetUserAction()
    {
        $email = $this->faker->email;
        $password = $this->faker->randomNumber(6);
        $this->newUser($email, $password);

        /** @var User $user */
        $user = $this->logIn($email, $password);
        $this->assertNotEmpty($user->getId());
        $this->assertEquals($user->getRoles()[0], User::ROLE_USER);

        // Access frontend route
        $this->client->request(
            'GET',
            '/' . $this->api['frontend'] . '/user/information/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse();
        $content = $response->getContent();
        $statusCode = $response->getStatusCode();
        $result = json_decode($content, true);

        $this->assertTrue(200 === $statusCode);
        $this->assertNotNull($result);
        $this->assertEquals($user->getId(), $result['id']);

        // Access backend Page route
        $this->client->request(
            'GET',
            '/' . $this->api['backend'] . '/page/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse();
        $content = $response->getContent();
        $statusCode = $response->getStatusCode();
        $result = json_decode($content, true);

        $this->assertTrue(403 === $statusCode);
        $this->assertEquals($result['message'], 'Access Denied.');
    }

}
