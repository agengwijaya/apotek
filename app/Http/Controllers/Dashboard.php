<?php

namespace App\Http\Controllers;

use App\Models\HutangUsaha;
use App\Models\PiutangUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\GudangStok;
use App\Models\MitraInvoice;
use App\Models\PendampinganJadwal;

class Dashboard extends Controller
{
    public function index()
    {
        return view('dashboard.index', []);
    }
}
