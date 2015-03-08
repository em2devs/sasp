<?php

namespace Model;

class ResourceRole
{

    private $id;
    private $id_role;
    private $id_resource;
    protected $role;
    protected $resource;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdRole()
    {
        return $this->id_role;
    }

    public function setIdRole($idRole)
    {
        $this->id_role = $idRole;
    }

    public function getIdResource()
    {
        return $this->id_resource;
    }

    public function setIdResource($idResource)
    {
        $this->id_resource = $idResource;
    }

    public function getRole()
    {
        return $this->role;
    }
    
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    public function getResource()
    {
        return $this->resource;
    }
    
    public function setResource($resource)
    {
        $this->resource = $resource;
    }
}
