<?php

//carrefa todas as classes na pasta class

/*    spl_autoload_register(
        function ($class_name)
        {
            $filename= $class_name.'.php';

            if(file_exists(($class_name)))
            {
                require_once ($filename);
            }
        }
    );*/

function incluirClasse($classeNome)
{
    require_once ('class' . DIRECTORY_SEPARATOR . $classeNome.".php");

}


spl_autoload_register("incluirClasse");

