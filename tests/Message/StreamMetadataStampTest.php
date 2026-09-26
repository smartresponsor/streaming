<?php

declare(strict_types=1);

namespace App\Streaming\Tests\Message;

use App\Streaming\Message\StreamMetadataStamp;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class StreamMetadataStampTest extends TestCase
{
    public function testItKeepsBrokerNeutralMetadata(): void
    {
        $stamp = new StreamMetadataStamp('order-events', 'order-42', 3);

        self::assertSame('order-events', $stamp->stream);
        self::assertSame('order-42', $stamp->key);
        self::assertSame(3, $stamp->schemaVersion);
    }

    public function testSchemaVersionDefaultsToOne(): void
    {
        $stamp = new StreamMetadataStamp('order-events');

        self::assertSame(1, $stamp->schemaVersion);
        self::assertNull($stamp->key);
    }

    public function testItRejectsBlankStreamNames(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Stream name must not be empty.');

        new StreamMetadataStamp('   ');
    }

    public function testItRejectsStreamNamesWithBoundaryWhitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Stream name must not contain leading or trailing whitespace.');

        new StreamMetadataStamp(' order-events ');
    }

    public function testItRejectsNonPositiveSchemaVersions(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Schema version must be greater than zero.');

        new StreamMetadataStamp('order-events', schemaVersion: 0);
    }

    public function testItSurvivesNativeMessengerTransportSerialization(): void
    {
        $stamp = new StreamMetadataStamp('order-events', 'order-42', 3);
        $restored = unserialize(serialize($stamp), ['allowed_classes' => [StreamMetadataStamp::class]]);

        self::assertInstanceOf(StreamMetadataStamp::class, $restored);
        self::assertSame('order-events', $restored->stream);
        self::assertSame('order-42', $restored->key);
        self::assertSame(3, $restored->schemaVersion);
    }
}
