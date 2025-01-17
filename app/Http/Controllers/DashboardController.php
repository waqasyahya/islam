<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Roles;
use App\Models\ComponentPermissions;
use App\Models\Users;
use App\Http\Controllers\baseController;
use App\Helpers;

class DashboardController extends Controller
{
    public function index(){
        return view('AdminPanel.Dashboard.index');
    }
}
