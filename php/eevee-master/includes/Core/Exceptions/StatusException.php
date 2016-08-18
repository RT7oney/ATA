<?php

namespace Core\Exceptions;

use Exception;
use Core\Models\Status;

class StatusException extends Exception {

    public $status;

    public function __construct(Status $status)
    {
        $this->status = $status;

        parent::__construct($status->message, $status->code);
    }

}