<?php
namespace Organization\Model;

 use Zend\Db\TableGateway\TableGateway;

 class OrganizationTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getOrganization($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveOrganization(Organization $org)
     {
         $data = array(
             'name' => $org->name,
             'address'  => $org->address,
	     'post_code' => $org->post_code,
             'contact_number'  => $org->contact_number,
	     'contact_person' => $org->contact_person,
             'contact_web'  => $org->contact_web,
	     'esol_assesment' => $org->esol_assesment,
             'tutors_qualified'  => $org->tutors_qualified,
	     'tutors_qualified_condition' => $org->tutors_qualified_condition,
             'courses_acreditated'  => $org->courses_acreditated,
	     'courses_acreditation_condition' => $org->courses_acreditation_condition,
             'how_acreditated'  => $org->how_acreditated,
	     'core_curriculum' => $org->core_curriculum,
             'core_curriculum_condition'  => $org->core_curriculum_condition,
	     'referral_system' => $org->referral_system,
             'classes_outside_newham'  => $org->classes_outside_newham,
	     'other_information' => $org->other_information,
           );

         $id = (int) $organization->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getOrganization($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Organization id does not exist');
             }
         }
     }

     public function deleteOrganization($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
?>
