<?php
 namespace Organization\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Organization\Model\Organization;          
 use Organization\Form\OrganizationForm;   


 class OrganizationController extends AbstractActionController
 {
     protected $organizationTable;

     public function indexAction()
     {
	return new ViewModel(array(
             'organizations' => $this->getOrganizationTable()->fetchAll(),
         ));
     }

     public function addAction()
     {
	$form = new OrganizationForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $organization = new Organization();
             $form->setInputFilter($organization->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $organization->exchangeArray($form->getData());
                 $this->getOrganizationTable()->saveOrganization($organization);

                 // Redirect to list of Organizations
                 return $this->redirect()->toRoute('organizations');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
	$id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('organizations', array(
                 'action' => 'add'
             ));
         }

         // Get the Organization with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $organization = $this->getOrganizationTable()->getOrganization($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('organizations', array(
                 'action' => 'index'
             ));
         }

         $form  = new OrganizationForm();
         $form->bind($organization);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($organization->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getOrganizationTable()->saveOrganization($organization);

                 // Redirect to list of organizations
                 return $this->redirect()->toRoute('organizations');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
	$id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('organizations');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getOrganizationTable()->deleteOrganization($id);
             }

             // Redirect to list of Organizations
             return $this->redirect()->toRoute('organizations');
         }

         return array(
             'id'    => $id,
             'organizations' => $this->getOrganizationTable()->getOrganization($id)
         );
     }

     public function getOrganizationTable()
     {
         if (!$this->organizationTable) {
             $sm = $this->getServiceLocator();
             $this->organizationTable = $sm->get('Organization\Model\OrganizationTable');
         }
         return $this->organizationTable;
     }
 }
?>
