# php-fiber-actor

Asynchronous cooperative actor concurrency engine using native PHP 8.1+ Fibers.

## Features
- **Native Fibers**: Eliminates multi-threading overhead using lightweight coroutine primitives.
- **Mailbox Dispatch**: Suspends fibers automatically when queues are empty and resumes on message arrival.
