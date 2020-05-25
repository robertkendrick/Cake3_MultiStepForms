<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    /**
     * use beforeRender to send session parameters to the layout view
     */
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
//      $session = $this->getRequest()->getSession();
        $params = $this->session->read('form.params');
        $this->set('params', $params);
    }

    /**
     * delete session values when going back to index
     * you may want to keep the session alive instead
     */
    public function msfIndex() {
        $this->session->delete('form');	// start with a clean slate
    }

    /**
     * this method is executed before starting the form and retrieves one important parameter:
     * the form steps number
     * you can hardcode it, but in this example we are getting it by counting the number of files that start with msf_step_
     */
    public function msfSetup() {
//      App::uses('Folder', 'Utility');
//      $usersViewFolder = new Folder(APP.'View'.DS.'Users');
//      $steps = count($usersViewFolder->find('msf_step_.*\.ctp'));
//      $this->Session->write('form.params.steps', $steps);
        $this->session->write('form.params.steps', 4);
        $this->session->write('form.params.maxProgress', 0);
        $this->redirect(array('action' => 'msfStep', 1));
    }

    /**
     * this is the core step handling method
     * it gets passed the desired step number, performs some checks to prevent smart users skipping steps
     * checks fields validation, and when succeding, it saves the array in a session, merging with previous results
     * if we are at last step, data is saved
     * when no form data is submitted (not a POST request) it sets this->request->data to the values stored in session
     */
    public function msfStep($stepNumber) {

        /**
          * check if a view file for this step exists, otherwise redirect to index
          */
		if (!file_exists(APP.'Template'.DS.'Users'.DS.'msf_step_'.$stepNumber.'.ctp')) {
			$this->Flash->error('No such View file exists !');
            return $this->redirect('/users/msfIndex');
        }

        //pr('Dont think i get here'); die();
        /**
          * determines the max allowed step (the last completed + 1)
          * if choosen step is not allowed (URL manually changed) the user gets redirected
          * otherwise we store the current step value in the session
          */
        $maxAllowed = $this->session->read('form.params.maxProgress') + 1;
        if ($stepNumber > $maxAllowed) {
            return $this->redirect('/users/msfStep/'.$maxAllowed);
        } else {
            $this->session->write('form.params.currentStep', $stepNumber);
        }

        /**
          * check if some data has been submitted via POST
          * if not, sets the current data to the session data, to automatically populate previously saved fields
          */
        if ($this->request->is('post')) {
            /**
              * set passed data to the model, so we can validate against
              *  it without saving
              */
            /**
              * if data validates we merge previous session data
              *  with submitted data, using CakePHP powerful Hash
              *  class (previously called Set)
              */
			$bkVal = $this->Users->validationDefault(new \Cake\Validation\Validator);
			$bkErrors = $bkVal->errors($this->request->getData());
			if (empty($bkErrors)) {					
//              if ($this->Users->validates()) {
                $prevSessionData = $this->session->read('form.data');
				$currentSessionData = \Cake\Utility\Hash::merge( (array) 
									$prevSessionData, $this->request->data);
				//bobk - want this in all steps, it was missed out on the last step below
				$this->session->write('form.data', $currentSessionData);
									/**
            	  * if this is not the last step we replace session data with the new merged array
                  * update the max progress value and redirect to the next step
                  */
                if ($stepNumber < $this->session->read('form.params.steps')) {
//                    $this->session->write('form.data', $currentSessionData);
                    $this->session->write('form.params.maxProgress', $stepNumber);
                    return $this->redirect(array('action' => 'msfStep', $stepNumber+1));
				} else {
					/**
					* otherwise, this is the final step, so we have to save
					*  the data to the database
					*/
					// orig $this->Users->save($currentSessionData);
					// with validation -- although its already done above
					$user = $this->Users->newEntity($currentSessionData);
					// Convert to an Entity object. Validation already done
					//$user = $this->Users->newEntity($currentSessionData, ['validate' => false]);
					if ( $user->errors() ) {
						// Entity failed validation - error fields not set
						echo 'Entity failed validation'; 
						pr($user->errors); die();
					}
					if ( $this->Users->save($user) ) {
						$this->Flash->success(__('Your Account has been created'));
						return $this->redirect('/users/msfIndex');
					}
					else {
						//					pr($user->errors()); die();	Application Rule errors
						foreach ($user->errors() as $k => $item) {
							foreach ($item as $key => $value) {
								$this->Flash->error($k.": ".$value);
							}
						}
					/*
					$i = 0;
					$keys = array_keys($user->errors());
					foreach ($user->errors() as $item) {
					foreach ($item as $key => $value) {
					$this->Flash->error($keys[$i++].": ".$value);
					}
					}
					*/
						$this->Flash->error(__('Unable to add your Account.'));
//						return $this->redirect('/users/msfIndex');
					}
				}
            } else {	// we have validation errors
				// set up to diplay the validation errors
				echo 'we have validation errors';
				foreach ($bkErrors as $item) {
					foreach ($item as $key => $value) {
						$this->Flash->error($value);
					}
				}
            }
		} else {	// not a post request - prepare and render the form
			$this->request->data = $this->session->read('form.data');
			/**
			  * here we load the proper view file, depending on the stepNumber
			  *  variable passed via GET
			  */
			  //            $this->viewBuilder()->setTemplate('msfStep_'.$stepNumber);
		}
		return $this->render('msfStep_'.$stepNumber);
    }
}
