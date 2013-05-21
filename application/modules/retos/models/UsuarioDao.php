
<?php
 
class Usuarios_Model_UsuarioDao
{
    private $_table;
   
    public function __construct()
    {
        $this->_table = new Usuarios_Model_DbTable_Usuario();
    }
   
    public function obtenerTodos()
    {
        $usuarios = new ArrayObject();
       
        foreach ($this->_table->fetchAll() as $row) {
            $usuario = new Usuarios_Model_Usuario();
            $usuario->setId($row->id);
            $usuario->setNombre($row->nombre);
            $usuario->setApellido($row->apellido);
            $usuario->setEmail($row->email);
            $usuario->setPassword($row->password);
            $usuarios->append($usuario);
        }
        return $usuarios;
    }
   
    public function guardar(Usuarios_Model_Usuario $usuario)
    {
        if ($usuario->getId() === null) {
            $row = $this->_table->createRow();
        }
        else {
            $row = $this->_table->find($usuario->getId())->current();
        }
       
        $row->nombre = $usuario->getNombre();
        $row->apellido = $usuario->getApellido();
        $row->email = $usuario->getEmail();
        $row->password = $usuario->getPassword();
       
        $row->save();
    }
   
    public function eliminar(Usuarios_Model_Usuario $usuario)
    {
        $row = $this->_table->find($usuario->getId())->current();
       
        if ($row !== null) {
            $row->delete();
            return true;
        }
        return false;
    }
   
    public function obtenerPorId($id)
    {
        $row = $this->_table->find($id)->current();
       
        if ($row !== null) {
            $usuario = new Usuarios_Model_Usuario();
            $usuario->setId((int) $row->id);
            $usuario->setNombre($row->nombre);
            $usuario->setApellido($row->apellido);
            $usuario->setEmail($row->email);
            $usuario->setPassword($row->password);
            return $usuario;
        }
        return null;
    }
    
    public function buscarPorNombre($nombre)
    {
        $usuarios = new ArrayObject();
        
        $select = $this->_table->select()->where('nombre = ?', $nombre);
        $result = $this->_table->fetchRow($select);
       
        if ($result !== null) {
            $usuario = new Usuarios_Model_Usuario();
            $usuario->setId((int) $result->id);
            $usuario->setNombre($result->nombre);
            $usuario->setApellido($result->apellido);
            $usuario->setEmail($result->email);
            $usuario->setPassword($result->password);
            $usuarios->append($usuario);
            return $usuarios;
        }
        return null;
    }
    
    public function buscarPorEmail($email)
    {
        $usuarios = new ArrayObject();
        
        $select = $this->_table->select()->where('email = ?', $email);
        $result = $this->_table->fetchRow($select);
       
        if ($result !== null) {
            $usuario = new Usuarios_Model_Usuario();
            $usuario->setId((int) $result->id);
            $usuario->setNombre($result->nombre);
            $usuario->setApellido($result->apellido);
            $usuario->setEmail($result->email);
            $usuario->setPassword($result->password);
            $usuarios->append($usuario);
            return $usuarios;
        }
        return null;
    }
    
    public function obtenerPassword($id)
    {
        //return $this->_usuarios[$id->obtenerId()]->obtenerPass();
        return $id->getPassword();


    }
}

