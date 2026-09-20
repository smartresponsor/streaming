<?php

declare(strict_types=1);

namespace App\Streaming\Tests\Contract;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

final class StreamContractTest extends TestCase
{
    public function testStreamingContractKeepsTheRcBoundaryBrokerNeutral(): void
    {
        $contract = Yaml::parseFile(dirname(__DIR__, 2).'/resources/contract/streaming.yaml');

        self::assertIsArray($contract);
        self::assertSame('streaming', $contract['component'] ?? null);
        self::assertSame('App\\Streaming', $contract['namespace'] ?? null);
        self::assertSame(
            [
                'admin' => true,
                'user_web' => false,
                'mobile' => false,
            ],
            $contract['surface'] ?? null,
        );
        self::assertSame(
            [
                'owns_business_state' => false,
                'event_sourcing' => false,
            ],
            $contract['state'] ?? null,
        );

        $broker = $contract['broker'] ?? null;
        self::assertIsArray($broker);
        self::assertNull($broker['selected'] ?? null);
        self::assertSame('kafka', $broker['protocol_target'] ?? null);

        self::assertSame(
            [
                'entities' => false,
                'migrations' => false,
                'outbox' => 'future',
            ],
            $contract['persistence'] ?? null,
        );
    }

    public function testHostContractRequiresProductionVcsWithoutAPathRepository(): void
    {
        $contract = Yaml::parseFile(dirname(__DIR__, 2).'/resources/contract/host.yaml');

        self::assertIsArray($contract);
        $host = $contract['host'] ?? null;
        self::assertIsArray($host);

        self::assertSame('App\\Streaming\\StreamingBundle', $host['bundle'] ?? null);
        self::assertSame(
            [
                'composer_repository' => 'vcs',
                'package' => 'streaming/stream',
                'remote_required' => true,
                'path_repository_forbidden' => true,
            ],
            $host['production'] ?? null,
        );
        self::assertSame(
            [
                'easyadmin' => true,
                'standalone_web' => false,
                'mobile' => false,
            ],
            $contract['surface'] ?? null,
        );
    }
}
