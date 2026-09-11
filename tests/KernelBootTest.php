<?php

declare(strict_types=1);

namespace App\Streaming\Tests;

use App\Streaming\Kernel;
use App\Streaming\StreamingBundle;
use PHPUnit\Framework\TestCase;

final class KernelBootTest extends TestCase
{
    public function testStandaloneKernelBoots(): void
    {
        $kernel = new Kernel('test', true);

        try {
            $kernel->boot();

            self::assertSame('test', $kernel->getEnvironment());
            self::assertInstanceOf(StreamingBundle::class, $kernel->getBundle('StreamingBundle'));
        } finally {
            $kernel->shutdown();
        }
    }
}
