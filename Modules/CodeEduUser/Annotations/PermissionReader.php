<?php

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\Action;
use CodeEduUser\Annotations\Mapping\Controller;
use Doctrine\Common\Annotations\Reader;


class PermissionReader{
    /**
     * @var Reader
     */
    private $reader;


    /**
     * PermissionReader constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {

        $this->reader = $reader;
    }

    /**
     *
     */
    public function getPermissions(){

    }

    /**
     * @param $controllerClass
     */
    public function getPermission($controllerClass){
        $rc = new \ReflectionClass($controllerClass);
        $controllerAnnotation = $this->reader->getClassAnnotation($rc, Controller::class);
        $permissions = [];
        if ($controllerAnnotation){
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];
            $rcMethod = $rc->getMethods();
            foreach ($rcMethod as $rcMethod){
                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, Action::class);
                if ($actionAnnotation){
                    $permission['resource_name']= $actionAnnotation->name;
                    $permission['resource_description']= $actionAnnotation->description;

                    $permissions[]= (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }
        return $permissions;
    }

}