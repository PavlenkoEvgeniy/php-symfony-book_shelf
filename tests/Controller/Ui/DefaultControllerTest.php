<?php

namespace Tests\Controller\Ui;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePageRedirect(): void
    {
        $client = $this->createClient();

        $client->request('get', '/');

        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/ui/book-shelf');
    }
}