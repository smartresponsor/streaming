<?php

declare(strict_types=1);

namespace App\Streaming\Messenger;

use InvalidArgumentException;
use Symfony\Component\Messenger\Stamp\StampInterface;

final readonly class StreamMetadataStamp implements StampInterface
{
    public function __construct(
        public string $stream,
        public ?string $key = null,
        public int $schemaVersion = 1,
    ) {
        if ('' === trim($this->stream)) {
            throw new InvalidArgumentException('Stream name must not be empty.');
        }

        if ($this->schemaVersion < 1) {
            throw new InvalidArgumentException('Schema version must be greater than zero.');
        }
    }
}
