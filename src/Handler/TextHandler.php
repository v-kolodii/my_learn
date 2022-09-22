<?php

namespace App\Handler;


class TextHandler implements HandlerInterface
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function prepareText()
    {
        return strip_tags($this->text);
    }
}