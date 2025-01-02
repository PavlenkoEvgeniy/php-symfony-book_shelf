<?php

namespace Tests\Controller\Ui;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookShelfControllerTest extends WebTestCase
{
    public function testBookShelfControllerIsRespondingOk(): void
    {
        $client = $this->createClient();

        $client->request('get', '/ui/book-shelf');

        $this->assertResponseIsSuccessful();
    }

    public function testBookShelfControllerHasView(): void
    {
        $client = $this->createClient();

        $client->request('get', '/ui/book-shelf');

        $this->assertSelectorTextContains('h1', 'Welcome to book shelf');
    }
}