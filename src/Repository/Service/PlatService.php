<?php 

namespace App\Service;

use Doctrine\ORM\EntityManager;


class PlatService extends AbstractService
{

    public function __construct(EntityManager $em, $entityName)
    {
        $this->em = $em;
        $this->model = $em->getRepository($entityName);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPlat($plat_id)
    {
        return $this->find($plat_id);
    }

    public function getAllPlats()
    {
        return $this->findAll();
    }

    public function addPlat()
    {
        return $this->save();
    }

    public function deletePlat($id)
    {   
        return $this->delete($this->find($id));
    }



}