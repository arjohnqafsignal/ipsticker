<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Sticker;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
class Stickers extends Component
{
     /**
     * @var string
     */
    public $sortField = 'letter_id';

    public function render()
    {
        return view('livewire.stickers');
    }
}
