<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Seat Entity
 *
 * @property int $id
 * @property int|null $seat_number
 * @property string|null $status
 *
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Seat extends Entity
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
        'seat_number' => true,
        'status' => true,
        'bookings' => true,
    ];

    public function updateStatus($seatId, $status): bool
    {
        $seat = $this->get($seatId);
        $seat->status = $status;
        $this->save($seat);
    }
}
