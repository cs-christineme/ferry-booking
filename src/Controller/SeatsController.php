<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Seats Controller
 *
 * @property \App\Model\Table\SeatsTable $Seats
 * @method \App\Model\Entity\Seat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $seats = $this->paginate($this->Seats);
        $this->set(compact('seats'));
    }

    /**
     * View method
     *
     * @param string|null $id Seat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seat = $this->Seats->get($id, [
            'contain' => ['Bookings'],
        ]);
        $this->set(compact('seat'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Bookings');
        $this->loadModel('Seats');
        $booking = $this->Bookings->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $seatId = $data['seat_id'];
            $userId = 1; // Replace with the currently logged in user's ID
            $bookingDate = date('Y-m-d'); // Replace with the selected booking date

            // Create a new booking
            $booking = $this->Bookings->createBooking($userId, $seatId, $bookingDate);

            if ($booking) {
                // Update the seat status to 'booked'
                $this->Seats->updateStatus($seatId, 'booked');

                $this->Flash->success(__('Booking has been saved.'));
                return $this->redirect(['action' => 'view', $booking->id]);
            } else {
                $this->Flash->error(__('The booking could not be saved. Please, try again.'));
            }
        }

        $seats = $this->Bookings->Seats->find('list', ['conditions' => ['status' => 'available']]);
        $this->set(compact('booking', 'seats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Seat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $seat = $this->Seats->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seat = $this->Seats->patchEntity($seat, $this->request->getData());
            if ($this->Seats->save($seat)) {
                $this->Flash->success(__('The seat has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the seat. Please, try again.'));
        }
        $this->set(compact('seat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Seat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seat = $this->Seats->get($id);
        if ($this->Seats->delete($seat)) {
            $this->Flash->success(__('The seat has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the seat. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
