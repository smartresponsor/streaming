<?php

declare(strict_types=1);

namespace App\Streaming\Tests\Messenger;

use App\Streaming\Messenger\StreamMetadataStamp;
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

    public function testItRejectsNonPositiveSchemaVersions(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Schema version must be greater than zero.');

        new StreamMetadataStamp('order-events', schemaVersion: 0);
    }
}
