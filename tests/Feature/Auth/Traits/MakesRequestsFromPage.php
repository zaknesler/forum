<?php

namespace Tests\Feature\Auth\Traits;

trait MakesRequestsFromPage
{
    protected function fromPage($uri)
    {
        return $this->withServerVariables(['HTTP_REFERER' => $uri]);
    }
}
