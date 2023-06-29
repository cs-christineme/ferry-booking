<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSeats extends AbstractMigration
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
        $seats = $this->table('seats')
        ->addColumn('seat_number', 'integer', ['null' => false])
        ->addColumn('status', 'string', ['limit' => 20, 'default' => 'available'])
        ->addIndex('seat_number', ['unique' => true])
        ->create();
    }
}
