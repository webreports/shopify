<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use WebReports\Shopify\OrderNotes;

class OrderNotesTest extends TestCase
{

    /** @var OrderNotes */
    private $orderNotes;

    protected function setUp()
    {
        $this->orderNotes = new OrderNotes();
    }
    
    public function testGetOrderNotesEmptyArray()
    {
        $orderArray = [];

        $notes = $this->orderNotes->getOrderNotes($orderArray);

        $this->assertEmpty($notes);
    }

    public function testGetOrderNotesParsesCorrectKeyValues()
    {
        $keyOne = "keyOne";
        $keyTwo = "keyTwo";
        $valueOne = "valueOne";
        $valueTwo = "valueTwo";

        $orderArray = [
            'order_id' => 1321321352,
            'note_attributes' => [
                ['name' => $keyOne, 'value' => $valueOne], ['name' => $keyTwo, 'value' => $valueTwo],
            ]
        ];

        $notes = $this->orderNotes->getOrderNotes($orderArray);

        $this->assertArrayHasKey($keyOne, $notes);
        $this->assertArrayHasKey($keyTwo, $notes);
        $this->isTrue($notes[$keyOne] == $valueOne);
        $this->isTrue($notes[$keyOne] == $valueTwo);
    }
}
