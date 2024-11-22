<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\Invoice;
use App\Service\EmailService;

class InvoiceTest extends KernelTestCase
{
  public function testInvoiceReturnsTrue()
  {

    /** @var EmailService&\PHPUnit\Framework\MockObject\MockObject $emailServiceMock */
    $emailServiceMock = $this->createMock(EmailService::class);

    $emailServiceMock
      ->expects($this->once())
      ->method('send')
      ->with('john@doe.com', 'Hello John')
      ->willReturn(true);

    $invoice = new Invoice($emailServiceMock);
    $this->assertTrue($invoice->process());
  }
}
