<?php

namespace App\Services\Student;

use App\Models\PortfolioItem;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    public function createPortfolioItem(array $data)
    {
        if (isset($data['file'])) {
            $data['file_path'] = $data['file']->store('portfolios', 'public');
        }

        return PortfolioItem::create($data);
    }
}
