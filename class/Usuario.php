<?php


    class Usuario{

        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;


        public function getIdusuario()
        {
            return $this->idusuario;
        }


        public function setIdusuario($usuario)
        {
            $this->idusuario = $usuario;
        }


        public function getDeslogin()
        {
            return $this->deslogin;
        }


        public function setDeslogin($deslogin)
        {
            $this->deslogin = $deslogin;
        }


        public function getDessenha()
        {
            return $this->dessenha;
        }


        public function setDessenha($dessenha)
        {
            $this->dessenha = $dessenha;
        }


        public function getDtcadastro()
        {
            return $this->dtcadastro;
        }


        public function setDtcadastro($dtcadastro)
        {
            $this->dtcadastro = $dtcadastro;
        }

        public function __construct($login ="", $pass="")
        {
            $this->setDeslogin($login);
            $this->setDessenha($pass);
        }

        public function loadById($id)
        {
             $sql = new Sql();

             $results =  $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID" , array(
                 ":ID"=>$id
             ));

             if(count($results) > 0)
             {
                 $this->setData($results[0]);
             }

        }

        public function __toString()
        {
            return json_encode(array(
                "idusuario"=>$this->getIdusuario(),
                "deslogin" =>$this->getDeslogin(),
                "dessenha" =>$this->getDessenha(),
                "dtcadstro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }

        public static function getList() // funão estatica pode ser chamada direto
        {
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
        }

        public static function search($login)
        {
            $sql = new Sql();

            return  $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SE ORDER BY deslogin", array(
                'SE'=>"%". $login . "%"
            ));
        }

        public function login($login, $password)
        {
            $sql = new Sql();

            $results =  $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND desenha = :PASSWORD",array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));

            if(count($results) > 0)
            {

                $this->setData($results[0]);

            }
            else
            {
                throw new  Exception("Login e/ou senha invalidos.");
            }

        }

        public function update($nome,$senha)
        {
            $this->setDeslogin($nome);
            $this->setDessenha($senha);

            $sql =  new Sql();

            $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN ,desenha= :SENHA WHERE idusuario = :ID",array(
                ":LOGIN"=>$this->getDeslogin(),
                ":SENHA"=>$this->getDessenha(),
                ":ID"=>$this->getIdusuario()
            ));
        }

        public function setData($data)
        {
            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin ($data['deslogin']);
            $this->setDessenha ($data['desenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));

        }

        public function insert()
        {
            $sql = new Sql();

            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
                ":LOGIN"   =>$this->getDeslogin(),
                ":PASSWORD"=>$this->getDessenha()
            ));

            if(count($results) >0)
            {
                $this->setData($results[0]);
            }
        }

        public function delete()
        {
            $sql = new Sql();

            $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID",array(
                ":ID"=>$this->getIdusuario()
            ));

            $this->setIdusuario(0);
            $this->setDeslogin ('');
            $this->setDessenha ('');
            $this->setDtcadastro(new DateTime());

        }

    }