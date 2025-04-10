<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IW\Workshop\PostService;
use IW\Workshop\Client\Curl;

final class PostServiceTest extends TestCase
{
    private Curl $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = $this->createMock(Curl::class);
    }

    public function testCreatePostSuccessful(): void
    {
        $responseBody = json_encode(['id' => 123]);

        $this->mockClient->method('post')
            ->willReturn([201, $responseBody]);

        $service = new PostService(client: $this->mockClient);

        $postId = $service->createPost(['title' => 'Test']);

        $this->assertSame(123, $postId);
    }

    public function testCreatePostFailsWithInvalidStatusCode(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Post could not be created.');

        $this->mockClient->method('post')
            ->willReturn([500, 'Internal Server Error']);

        $service = new PostService(client: $this->mockClient);

        $service->createPost(['title' => 'Fail']);
    }

    public function testCreatePostFailsWithMissingId(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('An id of article could not be retrieved.');

        $responseBody = json_encode(['title' => 'No ID here']);

        $this->mockClient->method('post')
            ->willReturn([201, $responseBody]);

        $service = new PostService(client: $this->mockClient);

        $service->createPost(['title' => 'No ID']);
    }
}
