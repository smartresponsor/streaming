# Streaming

Streaming is the Smart Responsor platform component for durable event-streaming integration.

The repository exists as a declared platform boundary before a production streaming broker is selected or required.

## Runtime target

- Symfony 8
- PHP 8.4+
- Root namespace: `App\\Streaming\\`
- Symfony-oriented structure under `src/`
- No Port/Adapter pattern
- No `src/Domain/`

## Platform dependencies

- EasyAdmin is the only planned presentation surface for Streaming. Streaming has no user-facing web or mobile UI responsibility.
- Objecting is required when Streaming introduces durable entities so shared identity/audit field packs remain consistent with the platform.
- Cruding is required when those entities need generic administrative CRUD exposure.
- Symfony Messenger is the application messaging integration boundary.

Streaming does not currently declare Doctrine entities or migrations. Objecting and Cruding are connected now as platform contracts, not as justification to invent persistence before a concrete streaming use case exists.

Interfacing, Viewing, and Navigating are not required by the initial skeleton because Streaming has no user-facing interface or standalone navigation surface. Its administrative entry point should be exposed by the Host application's EasyAdmin integration when an admin feature actually exists.

## Responsibility boundary

Streaming owns platform-level integration concerns for durable event streams, including the future conventions and runtime integration for:

- event envelopes and metadata
- serialization and schema/version policy
- stream/topic naming conventions
- publishing and consumption integration
- consumer groups and checkpoints/offsets
- replay policy
- idempotent consumption guidance
- observability of stream publishing and consumption
- integration with Symfony Messenger

Business components remain owners of their business events and state. Streaming does not own business semantics such as payments, notifications, delivery, orders, or messages.

Streaming is not the source of truth for business state and does not imply Event Sourcing. Doctrine-backed component state remains authoritative unless a component explicitly defines otherwise.

## Broker boundary

No broker implementation is selected by this initial skeleton.

Redpanda is the first candidate for evaluation because it exposes the Kafka protocol with a compact operational model. Apache Kafka remains a compatible architectural alternative. Broker-specific clients, configuration, deployment, and runtime dependencies must not leak into business components.

## Current scope

This initial repository intentionally contains only the Symfony bundle declaration and responsibility contract. It does not yet provide:

- Redpanda or Kafka runtime
- broker containers or deployment manifests
- producer/consumer implementations
- persistence or outbox entities
- Doctrine migrations
- topic provisioning
- application integration

Those capabilities should be introduced only when the platform has a concrete streaming use case.
