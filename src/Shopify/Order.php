<?php

namespace WebReports\Shopify;

use Adbar\Dot;
use WebReports\Shopify\OrderNotes;

class Order
{
    /** @var string */
    const CANCELLED_AT_KEY = "cancelled_at";

    /** @var string */
    const FINANCIAL_STATUS_KEY = "financial_status";

    /** @return bool */
    public static function isCancelled(array $order)
    {
        $dot = new Dot($order);
        $cancelled = $dot->get(self::CANCELLED_AT_KEY);
        return !is_null($cancelled);
    }

    /** @return bool */
    public static function isPartiallyRefunded(array $order)
    {
        $dot = new Dot($order);
        $partiallyRefunded = $dot->get(self::FINANCIAL_STATUS_KEY);
        return $partiallyRefunded == "partially_refunded";
    }

    /** @return bool */
    public static function isFullyRefunded(array $order)
    {
        $dot = new Dot($order);
        $fullyRefunded = $dot->get(self::FINANCIAL_STATUS_KEY);
        return $fullyRefunded == "refunded";
    }

    public static function getNotes(array $order)
    {
        return OrderNotes::getOrderNotes($order);
    }
}
