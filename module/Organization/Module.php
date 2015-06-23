<?php
namespace Organization;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 // Add these import statements:
 use Organization\Model\Organization;
 use Organization\Model\OrganizationTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module
 {
     // getAutoloaderConfig() and getConfig() methods here
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }

     // Add this method:
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Organization\Model\OrganizationTable' =>  function($sm) {
                     $tableGateway = $sm->get('OrganizationTableGateway');
                     $table = new OrganizationTable($tableGateway);
                     return $table;
                 },
                 'OrganizationTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Organization());
                     return new TableGateway('organization', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
?>
