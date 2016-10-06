<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
 
	
	public function tags() {
		return $this->belongsToMany(Tag::class);	
	}

	public function user()
	{
	    return $this->belongsTo(User::class);
	}
}
