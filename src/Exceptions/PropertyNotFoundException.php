<?php

namespace Vita\Booking\Exceptions;

class PropertyNotFoundException extends \Exception
{
    protected $message = "Property was not found";

}