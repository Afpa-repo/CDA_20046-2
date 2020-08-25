<?php
namespace App\Data;

use App\Entity\Theme;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $recherche = '';

    /**
     * @var Theme[]
     */
    public $themes = [];

}