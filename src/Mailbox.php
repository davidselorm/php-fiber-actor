<?php
namespace DevPulse\Actor;

class Mailbox {
    private array $queue = [];
    public function push(mixed $msg): void { $this->queue[] = $msg; }
    public function pop(): mixed { return array_shift($this->queue); }
    public function isEmpty(): bool { return empty($this->queue); }
}
