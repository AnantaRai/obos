<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSearchBar extends Component
{
    public $query;
    public $products;

    public function mount()
    {
       $this->clear();
    }

    public function clear()
    {
        $this->reset();
    }

    public function updatedQuery()
    {
        $this->products = Product::where('name', 'like', '%' . $this->query . '%')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.product-search-bar');
    }
}
