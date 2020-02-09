<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use WebReports\Shopify\Order;
use \DateTime;

class OrderTest extends TestCase
{
    public function testOrderIsCancelled()
    {
        $cancelledDate = new DateTime();
        $cancelledOrder = [
            'cancelled_at' => $cancelledDate->format(DATE_ISO8601)
        ];

        $this->assertTrue(Order::isCancelled($cancelledOrder));
    }

    public function testOrderIsNotCancelled()
    {
        $cancelledOrder = [
            'cancelled_at' => null,
        ];

        $this->assertFalse(Order::isCancelled($cancelledOrder));
    }

    public function testOrderIsPartiallyRefunded()
    {
        $partiallyRefundedOrder = [
            'financial_status' => 'partially_refunded',
        ];

        $this->assertFalse(Order::isFullyRefunded($partiallyRefundedOrder));
        $this->assertTrue(Order::isPartiallyRefunded($partiallyRefundedOrder));
    }

    public function testOrderIsFullyRefunded()
    {
        $fullyRefundedOrder = [
            'financial_status' => 'refunded',
        ];

        $this->assertFalse(Order::isPartiallyRefunded($fullyRefundedOrder));
        $this->assertTrue(Order::isFullyRefunded($fullyRefundedOrder));
    }
}
