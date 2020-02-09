<?php

namespace WebReports\Shopify;

class OrderNotes
{
    const NOTE_ATTRIBUTES_KEY = "note_attributes";

    /** @return array */
    public function getOrderNotes(array $order)
    {
        $orderNotes = array();
        if (array_key_exists(self::NOTE_ATTRIBUTES_KEY, $order)) {
            foreach ($order[self::NOTE_ATTRIBUTES_KEY] as $note) {
                $orderNotes[$note['name']] = $note['value'];
            }
        }

        return $orderNotes;
    }
}
