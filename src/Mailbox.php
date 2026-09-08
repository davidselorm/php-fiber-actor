<?php
namespace FiberActor;

class Mailbox {
    private array $queue = [];
    private int $capacity;

    public function __construct(int $capacity = 1000) {
        $this->capacity = $capacity;
    }

    public function push(mixed $item): bool {
        if (count($this->queue) >= $this->capacity) {
            return false;
        }
        $this->queue[] = $item;
        return true;
    }

    public function pop(): mixed {
        return array_shift($this->queue);
    }

    public function isEmpty(): bool {
        return empty($this->queue);
    }

    public function count(): int {
        return count($this->queue);
    }
}
