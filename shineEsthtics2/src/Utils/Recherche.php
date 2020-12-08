<?php


namespace App\Utils;


use App\Entity\Shop;
use App\Repository\ShopRepositoryRepository;

class Recherche
{
    /**
     * @var string|null
     */
    private $chaine;

    /**
     * @var Shop[] | null
     */
    private $categories = [];

    /**
     * @var array | null
     */
    private $typeProduit = [];

    /**
     * @return array|null
     */
    public function getTypeProduit(): ?array
    {
        return $this->typeProduit;
    }

    /**
     * @param array|null $typeProduit
     */
    public function setTypeProduit(?array $typeProduit): void
    {
        $this->typeProduit = $typeProduit;
    }

    /**
     * @return string|null
     */
    public function getChaine(): ?string
    {
        return $this->chaine;
    }

    /**
     * @param string|null $chaine
     */
    public function setChaine(?string $chaine): void
    {
        $this->chaine = $chaine;
    }

    /**
     * @return Shop[]|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param Shop []|null $categories
     * @return Recherche
     */
    public function setCategories(?array $categories): Recherche
    {
        $this->categories = $categories;
        return $this;
    }

}