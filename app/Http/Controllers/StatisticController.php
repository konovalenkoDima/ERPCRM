<?php

namespace App\Http\Controllers;

use App\Models\TeamLeadBuyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StatisticController extends Controller
{
    public function index()
    {
        if (Gate::allows("is_admin")) {
            $users = User::select("id", "name", "email", "access_level")->where("id", "!=", Auth::id())->orderBy("access_level")->get()->toArray();
        }

        if (Gate::allows("is_team_lead")) {
            $users = (new TeamLeadBuyer)->getBuyersByTeamLeadId(Auth::id())->toArray();
        }

        return view("dashboard", [
            "current_user" => User::select("id", "name", "email", "access_level")->find(Auth::id())->toArray(),
            "users" => $users ?? "",
        ]);
    }
}
