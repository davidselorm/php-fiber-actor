<?php
namespace FiberActor;

class Actor {
    private string $id;
    private Mailbox $mailbox;
    private ?\Fiber $fiber = null;
    private bool $running = false;

    public function __construct(string $id, int $capacity = 1000) {
        $this->id = $id;
        $this->mailbox = new Mailbox($capacity);
    }

    public function send(mixed $message): bool {
        return $this->mailbox->push($message);
    }

    public function start(callable $behavior): void {
        $this->running = true;
        $this->fiber = new \Fiber(function() use ($behavior) {
            while ($this->running) {
                while ($this->mailbox->isEmpty() && $this->running) {
                    \Fiber::suspend();
                }
                if (!$this->running) break;
                $msg = $this->mailbox->pop();
                if ($msg !== null) {
                    $behavior($msg);
                }
            }
        });
        $this->fiber->start();
    }

    public function resume(): void {
        if ($this->fiber && $this->fiber->isSuspended()) {
            $this->fiber->resume();
        }
    }

    public function stop(): void {
        $this->running = false;
        $this->resume();
    }
}
