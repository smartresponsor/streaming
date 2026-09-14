<?php

declare(strict_types=1);

namespace App\Streaming\Tests\DependencyInjection;

use App\Streaming\DependencyInjection\StreamingExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class StreamingExtensionTest extends TestCase
{
    public function testItLoadsStreamingServices(): void
    {
        $container = new ContainerBuilder();
        $extension = new StreamingExtension();

        $extension->load([], $container);

        self::assertTrue($container->hasDefinition('App\\Streaming\\StreamingBundle'));
    }
}
