<h1>Add Seat</h1>

<?= $this->Form->create($seat) ?>
<?= $this->Form->control('seat_number') ?>
<?= $this->Form->control('status') ?>
<?= $this->Form->button('Save') ?>
<?= $this->Form->end() ?>
