<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Booking extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function createBooking($userId, $seatId, $bookingDate)
    {
        $this->user_id = $userId;
        $this->seat_id = $seatId;
        $this->booking_date = $bookingDate;
        return $this;
    }
}
