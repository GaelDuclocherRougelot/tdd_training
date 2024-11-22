<?php

namespace App\Service;

use App\Service\EmailService;

class Invoice
{
  private EmailService $emailService;

  public function __construct(EmailService $emailService)
  {
    $this->emailService = $emailService;
  }

  public function process(): bool
  {
    return $this->emailService->send('john@doe.com', 'Hello John');
  }
}
