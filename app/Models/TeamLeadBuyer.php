<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamLeadBuyer extends Model
{
    use HasFactory;

    protected $table = "teamlead_buyer";

    protected $fillable = [
        "team_lead_id",
        "buyer_id",
    ];

    public function users()
    {
        return $this->hasMany(User::class, "id", "buyer_id");
    }

    public function getBuyersByTeamLeadId(int $teamLeadId)
    {
        $team = self::with("users")->firstWhere("team_lead_id", '=', $teamLeadId);

        return $team->users()->get();
    }
}
