<?php

namespace Orbitali\Events\Task;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Orbitali\Events\Event as TaskEvent;
use Orbitali\Http\Models\Task;

class Event extends TaskEvent
{
    use Dispatchable, SerializesModels;

    /**
     * @var Task
     */
    public $task;

    /**
     * Constructor.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
