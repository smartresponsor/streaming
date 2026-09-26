<?php

declare(strict_types=1);

namespace App\Streaming\Message;

use InvalidArgumentException;
use Symfony\Component\Messenger\Stamp\StampInterface;

/** Carries broker-neutral stream, partition-key, and schema-version metadata across Symfony Messenger boundaries. */
final readonly class StreamMetadataStamp implements StampInterface
{
    /** Validates immutable transport metadata before it is attached to a Messenger envelope. */
    public function __construct(
        public string $stream,
        public ?string $key = null,
        public int $schemaVersion = 1,
    ) {
        if ('' === trim($this->stream)) {
            throw new InvalidArgumentException('Stream name must not be empty.');
        }

        if ($this->stream !== trim($this->stream)) {
            throw new InvalidArgumentException('Stream name must not contain leading or trailing whitespace.');
        }

        if ($this->schemaVersion < 1) {
            throw new InvalidArgumentException('Schema version must be greater than zero.');
        }
    }
}
