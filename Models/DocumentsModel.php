<?php 
namespace App\Models;


class DocumentsModel extends Model
{
	protected $id;
    protected $numero;
    protected $cases;
    protected $contrat;
	protected $reference;
	protected $libelle;
	protected $description;
    protected $actif;
	protected $id_user;
    protected $id_usager;
    protected $tauxindem;
    protected $retenues;
    protected $gains;
    protected $montant;
    protected $reglement;
    protected $compte;
    protected $pieces;
    protected $logroupe;
    protected $baille;
    protected $logement;
    protected $arriere;
    protected $solde;
    protected $nbrep;
    protected $expertise;
    protected $decision;
    protected $datedecision;
    protected $imputation;
    protected $retour;
    protected $effet;
    protected $duree;
    protected $ville;
    protected $codebanque;
    protected $codeguichet;
    protected $domiciliation;
    protected $rib;
    protected $etabli;
    protected $status_doc;
	protected $id_annee;
    protected $id_types;
    protected $id_natures;
	protected $id_cat;
    protected $id_dos;
	protected $date_creat;
    protected $update_at;
	public function __construct()
	{
		$this->table = 'documents';
	}



    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     *
     * @return self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     *
     * @return self
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     *
     * @return self
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUsager()
    {
        return $this->id_usager;
    }

    /**
     * @param mixed $id_usager
     *
     * @return self
     */
    public function setIdUsager($id_usager)
    {
        $this->id_usager = $id_usager;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTauxindem()
    {
        return $this->tauxindem;
    }

    /**
     * @param mixed $tauxindem
     *
     * @return self
     */
    public function setTauxindem($tauxindem)
    {
        $this->tauxindem = $tauxindem;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetenues()
    {
        return $this->retenues;
    }

    /**
     * @param mixed $retenues
     *
     * @return self
     */
    public function setRetenues($retenues)
    {
        $this->retenues = $retenues;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     *
     * @return self
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReglement()
    {
        return $this->reglement;
    }

    /**
     * @param mixed $reglement
     *
     * @return self
     */
    public function setReglement($reglement)
    {
        $this->reglement = $reglement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * @param mixed $compte
     *
     * @return self
     */
    public function setCompte($compte)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * @param mixed $pieces
     *
     * @return self
     */
    public function setPieces($pieces)
    {
        $this->pieces = $pieces;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogroupe()
    {
        return $this->logroupe;
    }

    /**
     * @param mixed $logroupe
     *
     * @return self
     */
    public function setLogroupe($logroupe)
    {
        $this->logroupe = $logroupe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBaille()
    {
        return $this->baille;
    }

    /**
     * @param mixed $baille
     *
     * @return self
     */
    public function setBaille($baille)
    {
        $this->baille = $baille;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogement()
    {
        return $this->logement;
    }

    /**
     * @param mixed $logement
     *
     * @return self
     */
    public function setLogement($logement)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArriere()
    {
        return $this->arriere;
    }

    /**
     * @param mixed $arriere
     *
     * @return self
     */
    public function setArriere($arriere)
    {
        $this->arriere = $arriere;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param mixed $solde
     *
     * @return self
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbrep()
    {
        return $this->nbrep;
    }

    /**
     * @param mixed $nbrep
     *
     * @return self
     */
    public function setNbrep($nbrep)
    {
        $this->nbrep = $nbrep;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpertise()
    {
        return $this->expertise;
    }

    /**
     * @param mixed $expertise
     *
     * @return self
     */
    public function setExpertise($expertise)
    {
        $this->expertise = $expertise;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * @param mixed $decision
     *
     * @return self
     */
    public function setDecision($decision)
    {
        $this->decision = $decision;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImputation()
    {
        return $this->imputation;
    }

    /**
     * @param mixed $imputation
     *
     * @return self
     */
    public function setImputation($imputation)
    {
        $this->imputation = $imputation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetour()
    {
        return $this->retour;
    }

    /**
     * @param mixed $retour
     *
     * @return self
     */
    public function setRetour($retour)
    {
        $this->retour = $retour;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEffet()
    {
        return $this->effet;
    }

    /**
     * @param mixed $effet
     *
     * @return self
     */
    public function setEffet($effet)
    {
        $this->effet = $effet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdAnnee()
    {
        return $this->id_annee;
    }

    /**
     * @param mixed $id_annee
     *
     * @return self
     */
    public function setIdAnnee($id_annee)
    {
        $this->id_annee = $id_annee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdTypes()
    {
        return $this->id_types;
    }

    /**
     * @param mixed $id_types
     *
     * @return self
     */
    public function setIdTypes($id_types)
    {
        $this->id_types = $id_types;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdNatures()
    {
        return $this->id_natures;
    }

    /**
     * @param mixed $id_natures
     *
     * @return self
     */
    public function setIdNatures($id_natures)
    {
        $this->id_natures = $id_natures;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param mixed $id_cat
     *
     * @return self
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreat()
    {
        return $this->date_creat;
    }

    /**
     * @param mixed $date_creat
     *
     * @return self
     */
    public function setDateCreat($date_creat)
    {
        $this->date_creat = $date_creat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * @param mixed $update_at
     *
     * @return self
     */
    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     *
     * @return self
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdDos()
    {
        return $this->id_dos;
    }

    /**
     * @param mixed $id_dos
     *
     * @return self
     */
    public function setIdDos($id_dos)
    {
        $this->id_dos = $id_dos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEtabli()
    {
        return $this->etabli;
    }

    /**
     * @param mixed $etabli
     *
     * @return self
     */
    public function setEtabli($etabli)
    {
        $this->etabli = $etabli;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGains()
    {
        return $this->gains;
    }

    /**
     * @param mixed $gains
     *
     * @return self
     */
    public function setGains($gains)
    {
        $this->gains = $gains;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatedecision()
    {
        return $this->datedecision;
    }

    /**
     * @param mixed $datedecision
     *
     * @return self
     */
    public function setDatedecision($datedecision)
    {
        $this->datedecision = $datedecision;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomiciliation()
    {
        return $this->domiciliation;
    }

    /**
     * @param mixed $domiciliation
     *
     * @return self
     */
    public function setDomiciliation($domiciliation)
    {
        $this->domiciliation = $domiciliation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * @param mixed $rib
     *
     * @return self
     */
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodebanque()
    {
        return $this->codebanque;
    }

    /**
     * @param mixed $codebanque
     *
     * @return self
     */
    public function setCodebanque($codebanque)
    {
        $this->codebanque = $codebanque;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodeguichet()
    {
        return $this->codeguichet;
    }

    /**
     * @param mixed $codeguichet
     *
     * @return self
     */
    public function setCodeguichet($codeguichet)
    {
        $this->codeguichet = $codeguichet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusDoc()
    {
        return $this->status_doc;
    }

    /**
     * @param mixed $status_doc
     *
     * @return self
     */
    public function setStatusDoc($status_doc)
    {
        $this->status_doc = $status_doc;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCases()
    {
        return $this->cases;
    }

    /**
     * @param mixed $cases
     *
     * @return self
     */
    public function setCases($cases)
    {
        $this->cases = $cases;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * @param mixed $contrat
     *
     * @return self
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;

        return $this;
    }
}

 ?>