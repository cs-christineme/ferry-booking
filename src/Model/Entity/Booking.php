<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $seat_id
 * @property string|null $booking_date
 *
 * @property \App\Model\Entity\Seat $seat
 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'seat_id' => true,
        'booking_date' => true,
        'seat' => true,
    ];

    public function createBooking($userId, $seatId, $bookingDate)
    {
        $this->user_id = $userId;
        $this->seat_id = $seatId;
        $this->booking_date = $bookingDate;
       
        $this->save();
    }
}
