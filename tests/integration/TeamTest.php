<?php declare(strict_types=1);

namespace Tests\integration;

class TeamTest extends BaseTestCase
{
    private static $id;

    public function testCreateTeam()
    {
        $response = $this->runApp(
            'POST',
            '/team',
            [
                '' => '',
                'name' => 'aaa',
            ]
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeams()
    {
        $response = $this->runApp('GET', '/team');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeam()
    {
        $response = $this->runApp('GET', '/team/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeamNotFound()
    {
        $response = $this->runApp('GET', '/team/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateTeam()
    {
        $response = $this->runApp('PUT', '/team/' . self::$id, ['' => '']);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteTeam()
    {
        $response = $this->runApp('DELETE', '/team/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
