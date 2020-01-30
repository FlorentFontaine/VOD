<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{

    const GENRE = [
        0 => "Film",
        1 => "Série",
        3 => "documentaire"
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_episode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $musique;

    /**
     * @ORM\Column(type="boolean" , options={"defaults": false})
     */
    private $vu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer", options={"defaults": false})
     */
    private $genre;

        
    public function __construct()
    {
        $this->created_at = new \DateTime() ;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTemps(): ?string
    {
        return $this->temps;
    }

    public function setTemps(string $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getNbEpisode(): ?int
    {
        return $this->nb_episode;
    }

    public function setNbEpisode(?int $nb_episode): self
    {
        $this->nb_episode = $nb_episode;

        return $this;
    }

    public function getActeur(): ?string
    {
        return $this->acteur;
    }

    public function setActeur(string $acteur): self
    {
        $this->acteur = $acteur;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getMusique(): ?string
    {
        return $this->musique;
    }

    public function setMusique(string $musique): self
    {
        $this->musique = $musique;

        return $this;
    }

    public function getVu(): ?bool
    {
        return $this->vu;
    }

    public function setVu(bool $vu): self
    {
        $this->vu = $vu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
    public function getGenreType(): string{
        return self::GENRE[$this->genre];

    }
}
