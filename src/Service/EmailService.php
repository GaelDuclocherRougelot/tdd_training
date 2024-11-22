<?php

namespace App\Service;

class EmailService
{
  public function send(string $email, string $message): bool
  {
    return (bool)random_int(0, 1);
  }
}
