<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ScheduleMatch extends Model
{
    use HasFactory;

    protected $fillable = ['team1_name', 'team1_logo', 'team2_name', 'team2_logo', 'date_match', 'start_time', 'end_time', 'location'];

    //======== store new or update SchdeuleMatch =========================
    public static function store(Request $request, $id = null)
    {
        $data = $request->only('team1_name', 'team2_name', 'date_match', 'start_time', 'end_time', 'location');

        if ($request->hasFile('team1_logo')) {
            $imageName1 = time() . '.' . $request->file('team1_logo')->extension();
            $request->file('team1_logo')->storeAs('public/images', $imageName1);
            $data['team1_logo'] = 'images/' . $imageName1;
        }

        if ($request->hasFile('team2_logo')) {
            $imageName2 = time() . '.' . $request->file('team2_logo')->extension();
            $request->file('team2_logo')->storeAs('public/images', $imageName2);
            $data['team2_logo'] = 'images/' . $imageName2;
        }

        if (is_null($id)) {
            // Create new record
            return self::create($data);
        } else {
            // Update existing record
            $scheduleMatch = self::find($id);
            if ($scheduleMatch) {
                $scheduleMatch->update($data);
                return $scheduleMatch;
            } else {
                return null;
            }
        }
    }
}
