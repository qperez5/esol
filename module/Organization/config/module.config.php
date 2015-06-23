<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Organization\Controller\Organization' => 'Organization\Controller\OrganizationController',
         ),
     ),
	 // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'organization' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/organization[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Organization\Controller\Organization',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     
     'view_manager' => array(
         'template_path_stack' => array(
             'organization' => __DIR__ . '/../view',
         ),
     ),
 );

?>
