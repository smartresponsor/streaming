# Streaming milestones

## M0 — Repository and Symfony bundle

Status: complete.

- Separate `Streaming` repository.
- `smartresponsor/streaming` Symfony bundle.
- `App\Streaming\` namespace.
- Host development path/symlink integration.
- No broker runtime and no persistence.

## M1 — Broker-neutral platform contract

Status: complete.

- Self-loading Symfony service configuration.
- Symfony Messenger metadata contract.
- Explicit admin-only surface declaration.
- Redpanda and Apache Kafka remain implementation candidates behind the Kafka protocol boundary.

## M2 — Administrative shell

Status: planned.

- Add an EasyAdmin-only operational entry point.
- Show configuration/readiness state, broker connectivity, stream/topic inventory, and consumer health only when those capabilities exist.
- Do not introduce a standalone user-facing web page or mobile API.
- Use Host-owned administration/navigation integration rather than inventing a second admin shell.

## M3 — Durable integration state

Status: deferred until a concrete use case requires persistence.

- Introduce entities only for platform-owned durable integration state such as outbox records, publish attempts, consumer checkpoints, or provisioning metadata.
- When entities appear, use Objecting field packs and Cruding for generic administrative CRUD exposure.
- Doctrine entities are the durable schema source of truth.
- Migrations must be additive/adopt-or-create and production-safe.
- Streaming must not become the source of truth for business state and must not imply Event Sourcing.

## M4 — First broker implementation

Status: future.

- Evaluate Redpanda first.
- Preserve Kafka protocol compatibility.
- Keep broker-specific configuration and clients inside Streaming.
- Business components continue to communicate through Symfony/Messenger-facing contracts and never depend directly on Redpanda or Kafka SDKs.

## M5 — Production Host integration

Status: blocked on repository remote.

