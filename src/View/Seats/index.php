<h1>List of Seats</h1>
<table>
    <tr>
        <th>Seat Number</th>
        <th>Status</th>
    </tr>
    <?php foreach ($seats as $seat): ?>
        <tr>
            <td><?= h($seat->seat_number) ?></td>
            <td><?= h($seat->status) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
