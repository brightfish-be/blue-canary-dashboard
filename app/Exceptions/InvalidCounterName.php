<?php

namespace App\Exceptions;

/**
 * The counter name can only match `[a-z0-9-.]{6,255}`
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolssaet@brightfish.be>
 */
class InvalidCounterName extends BlueCanaryException
{

}
