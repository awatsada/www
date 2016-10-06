<?php namespace App\Http\Controllers;

use App\Comment;
use App\Tag;
use Redirect;
use Auth;
use Request;
use Mail;

class GuestbookController extends Controller {

	public function index() {
	    $comments = Comment::orderBy('updated_at','DESC')->paginate(5);
	    $tags = Tag::all();  
	    return view('guestbook.index', compact('comments','tags'));
	}

	public function reindex() {
		return Redirect::to('guestbook/index');
	}

    public function addComment() {
    	$comment = new Comment;
		$comment->user_id = Auth::user()->id;
		$comment->comment = Request::get('comment');
		$comment->ip = Request::get('ip');	
		$tags = Request::get('tags');
	    $comment->save();	
 		$comment->tags()->attach($tags);			
		return Redirect::to('guestbook/index');
    }

    public function editComment($id) {  
       	$comment = Comment::find($id);	
       	$tags = Tag::all();
		return View('guestbook.edit')->with('comment',$comment)->with('tags',$tags);		
    }

    public function saveComment($id) {  
       	$comment = Comment::find($id);		
       	// $comment->user_id = Auth::user()->id;
		$comment->comment = Request::get('comment');
		$comment->ip = Request::get('ip');	
		$tags = Request::get('tags');		
	    $comment->save(); 
	    if ( $tags != null)	
 			$comment->tags()->sync($tags);	 		
 		else				
 			$comment->tags()->sync([]);	 		
		return Redirect::to('guestbook/index');		
    }

    public function search() {
    	$query = Request::get('search');
	    //print_r($query);
	    $comments = Comment::where('comment','LIKE','%'.$query.'%')->get();
	    $count = Comment::where('comment','LIKE','%'.$query.'%')->count();
	    return view('guestbook.search', compact('comments','count'));
    }

    public function delete($id) {
    	$comment = Comment::find($id);  
	    $comment->delete();
	    return Redirect::to('guestbook/index');   
    }

    public function searchTag($id) { 
    	$tag = Tag::find($id);    
	    $comments = $tag->comments;
	    $count = $tag->comments->count();
	    return view('guestbook.search', compact('comments','count'));
    }

    public function submitEmail() {  
    	$toEmail = 'warodom.w@psu.ac.th';
	    $user = (object) array('toEmail' => $toEmail, 
	    						'toName' => 'Warodom Werapun', 	   						
	    						'fromEmail' => Request::get('email'),
	    						'fromName' => Request::get('name'),
	    						'fromSubject' => Request::get('subject'),
	    						'fromMessage' => Request::get('message') );

	    Mail::send('guestbook.mailTemplate', ['user' => $user], function ($m) use ($user) {
		        $m->from( $user->fromEmail,  $user->fromName );
		        $m->to($user->toEmail, $user->toName)->subject( $user->fromSubject );
	    	});
     	
  		return View('guestbook.contact')->with('toEmail',$toEmail);
    }    

    public function contact() {  
		return View('guestbook.contact');		
    }
}

?>



