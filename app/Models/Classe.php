<?php   

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "places",
        "user_id"
    
    ];
    public function courses (){
        return $this->hasMany(Calendar::class);
    }
}
