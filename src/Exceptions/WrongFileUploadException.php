<?php

namespace Vita\Booking\Exceptions;

class WrongFileUploadException extends \Exception
{
    protected $message = 'Error uploading file';
}