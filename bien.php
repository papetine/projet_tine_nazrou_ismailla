<?php
namespace location\dao;
use \PDO;
class Bien
{
    var $idb;
    var $nom;
    var $adresse;
    var $montantLoc;
    var $commission;
    var $idtypebien;
    var $idproprietaire;
    private $bdd;
    private function getConnexion(){
        try{
            $this->bdd = new PDO('mysql:host=;dbname=bdlocation;charset=utf8', 'root', ' ');
            $this->bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function addBien()
    {
        $this->getConnexion();
        // requete a executer
        $sql = "INSERT into bien VALUES(null, :nom, :adresse, :, :montantLoc, :idtypebien, :idproprietaire)";
        // preparation de la requete
        $req = $this->bdd->prepare($sql);
        //execution de la requete
        $data = $req->execute(
            array('nom'=>$this->nom,
                'adresse'=>$this->adresse,
                'commission'=>$this->commission,
                'idtypebien'=>$this->idtypebien,
                'idproprietaire'=>$this->idproprietaire
            ));
        return $data;
    }
    //methode find qui permet de retrouver un bien à travers son nom
    public static function find($Nom){
        $this->getConnexion();
        $sql = $this->bdd->query("SELECT * FROM bien WHERE nom = '".$Nom."'");
        if ($res = $sql->fetch()) {
            do{
                echo $res['nom']." trouvé";
            }while($res = $sql->fetch());
        }
        else
            echo "Aucun résultat trouvé";
    }
    //methode lister qui retourne la liste des biens
    public static function lister(){
        $this->getConnexion();
        $sql = $this->bdd->query("SELECT * FROM bien ");
        return $sql;
    }
    //methode listerByType qui retourne tous les biens d'un type donnée qui prend en paramètre l'id
    public static function listerByType($idType){
        $this->getConnexion();
        $sql = $this->bdd->query("SELECT * FROM bien WHERE idtypebien =".$idType);
        return $sql;
    }
    ?>