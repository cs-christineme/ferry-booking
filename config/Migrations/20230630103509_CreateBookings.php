<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBookings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $bookings = $this->table('bookings')
        ->addColumn('user_id', 'integer', ['null' => false])
        ->addColumn('seat_id', 'integer', ['null' => false])
        ->addColumn('booking_date', 'date', ['null' => false])
        ->addIndex('user_id')
        ->addIndex('seat_id')
        ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
        ->addForeignKey('seat_id', 'seats', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
        ->create();
    }
}
