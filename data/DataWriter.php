<?php
namespace data;

use service\DataWriterInterface;
include_once "service/DataWriterInterface.php";

class DataWriter implements DataWriterInterface
{
    protected $dataWriter = null;

    public function __construct($dataWriter)
    {
        $this->dataWriter = $dataWriter;
    }

    public function __destruct()
    {
        $this->dataWriter = null;
    }

    public function createUser($login, $pwd, $nom, $prenom)
    {
        $dateDuJour = date('Y-m-d');
        $query = 'INSERT INTO `Users` (`login`, `password`, `nom`, `prenom`, `dateCrea`) VALUES ("' . $login . '", "' . $pwd . '", "'. $nom .'", "'. $prenom .'", "'. $dateDuJour .'");';
        $this->dataWriter->query($query);
    }

    public function createPost($title, $body)
    {
        $dateDuJour = date('Y-m-d');
        $query = 'INSERT INTO `Post` (`date`, `title`, `body`) VALUES ("' . $dateDuJour . '", "' . $title . '", "' . $body .'");';
        $this->dataWriter->query($query);
    }

}

?>