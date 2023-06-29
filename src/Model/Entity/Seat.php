<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Seat extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function updateStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
