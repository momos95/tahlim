<?php

namespace TK\MediaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MediathequeControllerTest extends WebTestCase
{
    public function testAll()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/medias/liste/{page}');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/medias/add');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/medias/view/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/media/delete/{id}');
    }

}
