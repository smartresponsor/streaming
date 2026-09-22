<?php

declare(strict_types=1);

namespace App\Streaming\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/** Loads the broker-neutral Streaming service graph into a Symfony host or standalone runtime. */
final class StreamingExtension extends Extension
{
    /**
     * Registers Streaming-owned services without selecting or configuring a concrete broker.
     *
     * @param array<array-key, mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        unset($configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');
    }
}
