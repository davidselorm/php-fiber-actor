<?php
namespace DevPulse\Actor;

use Fiber;

class Actor {
    private Fiber $fiber;
    public function __construct(callable $behavior) {
        $this->fiber = new Fiber($behavior);
    }
    public function send(mixed $message): mixed {
        if (!$this->fiber->isStarted()) return $this->fiber->start($message);
        if ($this->fiber->isSuspended()) return $this->fiber->resume($message);
        return null;
    }
}
