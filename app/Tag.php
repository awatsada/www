<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{ 
	
	public function comments() {
		return $this->belongsToMany(Comment::class);
		// return $this->belongsToMany(Comment::class)->withTimestamps();
	}
}
