<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Controller;

class Controller
{
    public function render(string $inner, array $templateData = []): void
    {
        require './view/page.php';
    }
}
