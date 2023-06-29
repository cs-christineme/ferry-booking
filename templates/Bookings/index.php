<h1>List of Bookings</h1>
<table>
    <tr>
        <th>User ID</th>
        <th>Seat ID</th>
        <th>Booking Date</th>
    </tr>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?= h($booking->user_id) ?></td>
            <td><?= h($booking->seat_id) ?></td>
            <td><?= h($booking->booking_date) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
