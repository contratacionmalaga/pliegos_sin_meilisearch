<?php

namespace App\Http\Controllers;

use App\Enums\NavigationMenus\MiPanel;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        // Redirijo al panel que está definido por defecto
        return redirect(MiPanel::ADMIN->getPath());
    }
}
