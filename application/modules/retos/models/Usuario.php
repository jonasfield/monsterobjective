<?php

class Usuarios_Model_Usuario
{
    private $_idUsuario;
    private $_nombre;
    private $_apellido;
    private $_nick;
    private $_email;
    private $_password;
    private $_ciudad;
    private $_pais;
    private $_fecha_nacimiento;
    private $_idioma;
    private $_telefono;
    private $_foto_perfil;
    private $_role;
    private $_idInfoReto;
    
    function __construct($idUsuario = null, $nombre = null, $apellido = null, $nick = null, $email = null, $password = null, $ciudad = null, $pais = null, $fecha_nacimiento = null, $idioma = null, $telefono = null, $foto_perfil = null, $role = null, $idInfoReto = null )
    {
        $this->_idUsuario = $idUsuario;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_nick = $nick;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ciudad = $ciudad;
        $this->_pais = $pais;
        $this->_fecha_nacimiento = $fecha_nacimiento;
        $this->_idioma = $idioma;
        $this->_telefono = $telefono;
        $this->_foto_perfil = $foto_perfil;
        $this->_role = $role;
        $this->_idInfoReto = $idInfoReto;
    }
    
    public function getIdUsuario()
    {
        return $this->_idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->_idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->_apellido;
    }

    public function setApellido($apellido)
    {
        $this->_apellido = $apellido;
    }

    public function getNick()
    {
        return $this->_nick;
    }

    public function setNick($nick)
    {
        $this->_nick = $nick;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getCiudad()
    {
        return $this->_ciudad;
    }

    public function setCiudad($ciudad)
    {
        $this->_ciudad = $ciudad;
    }

    public function getPais()
    {
        return $this->_pais;
    }

    public function setPais($pais)
    {
        $this->_pais = $pais;
    }

    public function getFechaNacimiento()
    {
        return $this->_fecha_nacimiento;
    }

    public function setFechNacimiento($fechaNacimiento)
    {
        $this->_fecha_nacimiento = $fechaNacimiento;
    }

    public function get_idioma()
    {
        return $this->_idioma;
    }

    public function setIdioma($idioma)
    {
        $this->_idioma = $idioma;
    }

    public function getTelefono()
    {
        return $this->_telefono;
    }

    public function setTelefono($telefono)
    {
        $this->_telefono = $telefono;
    }

    public function getFotoPerfil()
    {
        return $this->_foto_perfil;
    }

    public function setFotoPerfil($fotoPerfil)
    {
        $this->_foto_perfil = $_foto_perfil;
    }

    public function get_role()
    {
        return $this->_role;
    }

    public function set_role($_role)
    {
        $this->_role = $_role;
    }

    public function get_idInfoReto()
    {
        return $this->_idInfoReto;
    }

    public function set_idInfoReto($_idInfoReto)
    {
        $this->_idInfoReto = $_idInfoReto;
    }



}

