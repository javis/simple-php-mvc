<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $fillable = ['title', 'description', 'author_id'];
    /**
     * Get the author of the book.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\Author','author_id');
    }
}
