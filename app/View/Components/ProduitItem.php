<?php

namespace App\View\Components;

use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use Illuminate\View\Component;

class ProduitItem extends Component
{

    public $produit;
    public $paProduits;
    public $shop;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Produit $produit, array $paProduits, Shop $shop)
    {
        $this->produit = $produit;
        $this->paProduits = $paProduits;
        $this->shop = $shop;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.produit-item');
    }
}
