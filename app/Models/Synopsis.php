<?php
// app/Models/Synopsis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Synopsis extends Model
{
    protected $fillable = ['movie_id', 'content'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
