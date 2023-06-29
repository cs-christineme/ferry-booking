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
        $seats = $this->Seats->find('all');
        $this->set('seats', $seats);
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
        $seat = $this->Seats->newEmptyEntity();
        if ($this->request->is('post')) {
            $seat = $this->Seats->patchEntity($seat, $this->request->getData());
            if ($this->Seats->save($seat)) {
                $this->Flash->success(__('The seat has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the seat.'));
        }
        $this->set('seat', $seat);
    }

    public function edit($id = null)
    {
        $seat = $this->Seats->get($id);
        if ($this->request->is(['post', 'put'])) {
            $seat = $this->Seats->patchEntity($seat, $this->request->getData());
            if ($this->Seats->save($seat)) {
                $this->Flash->success(__('The seat has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the seat.'));
        }
        $this->set('seat', $seat);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seat = $this->Seats->get($id);
        if ($this->Seats->delete($seat)) {
            $this->Flash->success(__('The seat has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the seat.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
