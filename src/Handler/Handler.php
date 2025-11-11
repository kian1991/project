<?php

namespace TaskFlow\Handler;

interface Handler
{
    public function handle(array $request): array;
}
