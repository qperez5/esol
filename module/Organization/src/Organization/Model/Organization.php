<?php
namespace Organization\Model;
// Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Organization implements InputFilterAwareInterface
 {
     public $id;
     public $name;
     public $address;
     public $post_code;
     public $contact_number;
     public $contact_person;
     public $contact_web;
     public $esol_assesment;
     public $tutors_qualified;
     public $tutors_qualified_condition;
     public $courses_acreditated;
     public $courses_acreditation_condition;
     public $how_acreditated;
     public $core_curriculum;
     public $core_curriculum_condition;
     public $referral_system;
     public $classes_outside_newham;
     public $other_information;
     protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->id = (!empty($data['id'])) ? $data['id'] : null;
         $this->name = (!empty($data['name'])) ? $data['name'] : null;
         $this->address  = (!empty($data['address'])) ? $data['address'] : null;
	 $this->post_code = (!empty($data['post_code'])) ? $data['post_code'] : null;
         $this->contact_number = (!empty($data['contact_number'])) ? $data['contact_number'] : null;
         $this->contact_person  = (!empty($data['contact_person'])) ? $data['contact_person'] : null;
	 $this->contact_web = (!empty($data['contact_web'])) ? $data['contact_web'] : null;
         $this->esol_assesment = (!empty($data['esol_assesment'])) ? $data['esol_assesment'] : null;
         $this->tutors_qualified  = (!empty($data['tutors_qualified'])) ? $data['tutors_qualified'] : null;
	 $this->tutors_qualified_condition = (!empty($data['tutors_qualified_condition'])) ? $data['tutors_qualified_condition'] : null;
         $this->courses_acreditated = (!empty($data['courses_acreditated'])) ? $data['courses_acreditated'] : null;
         $this->courses_acreditation_condition = (!empty($data['courses_acreditation_condition'])) ? $data['courses_acreditation_condition'] : null;
	 $this->how_acreditated = (!empty($data['how_acreditated'])) ? $data['how_acreditated'] : null;
         $this->core_curriculum = (!empty($data['core_curriculum'])) ? $data['core_curriculum'] : null;
         $this->core_curriculum_condition  = (!empty($data['core_curriculum_condition'])) ? $data['core_curriculum_condition'] : null;
	 $this->referral_system = (!empty($data['referral_system'])) ? $data['referral_system'] : null;
         $this->classes_outside_newham = (!empty($data['classes_outside_newham'])) ? $data['classes_outside_newham'] : null;
         $this->other_information  = (!empty($data['other_information'])) ? $data['other_information'] : null;

     }

     // Add the following method:
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

 // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'address',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 200,
                         ),
                     ),
                 ),
             ));
	     
	     $inputFilter->add(array(
                 'name'     => 'post_code',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 9,
                         ),
                     ),
                 ),
             ));

	     $inputFilter->add(array(
                 'name'     => 'contact_number',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 60,
                         ),
                     ),
                 ),
             ));

	     $inputFilter->add(array(
                 'name'     => 'contact_mail',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }

 }
?>
