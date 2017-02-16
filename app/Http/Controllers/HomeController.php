<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Fpdf;
use PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use \SoapClient;


use Input;
use Redirect;
use Auth;
use Validator;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
//     public function index()
//     {
//         return view('home');
//     }

//     public function in()
//     {
//         Fpdf::AddPage();
//         Fpdf::AddFont('angsana','','angsa.php');
//         Fpdf::SetFont('angsana','',14);
//         // Fpdf::Write(40,10,'ทดสอบ1');
//         $mytxt = 'ทดสอบ

// ';

//      Fpdf::Write( 5  , iconv( 'UTF-8','cp874' , $mytxt) , '' );



// $html='<table border="1">
// <tr>
// <td width="200" height="30">ทดสอบ 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
// </tr>
// <tr>
// <td width="200" height="30">cell 3</td><td width="200" height="30">ภาษาไทย 4</td>
// </tr>
// </table>';

// Fpdf::WriteHTML($html);

//         Fpdf::Output();
//         exit;
     
//     }

 public function getlog()
 {
    return view('log');
 }

 public function postlog()
 {
      $data = Input::all();
    $validator = Validator::make($data, [
                'username' => 'required',
                'password' => 'required',
            ]);

         
                $soap_user = new User(1);
                if($soap_user->Authenticate($data['username'], $data['password'])) {
                    $user = User::firstOrCreate(['username' => $data['username']]);
                    $user->name  = $soap_user->getFirstname() . " " . $soap_user->getLastname();
                    $user->email = $soap_user->getEmail();
                    $user->username = $data['username'];
                    $user->password = bcrypt($soap_user->getPid());
                    $user->save();
                    if(Auth::attempt(['username' => $data['username'], 'password' => $soap_user->getPid()])) {
                        echo "Login success.";
                        return Redirect::to('home');
                    } else {
                        echo "Login fail!";
                        
                    }
                    
                } else {
                    echo "Login fail!!";
                    
                }
            
 }













 public function in()
    {
        Fpdf::AddPage();
        Fpdf::AddFont('angsana','','angsa.php');
        Fpdf::SetFont('angsana','',14);
        // Fpdf::Write(40,10,'ทดสอบ1');
        $mytxt = 'ทดสอบ

';

     Fpdf::Write( 5  , iconv( 'UTF-8','cp874' , $mytxt) , '' );



$html='<table border="1">
<tr>
<td width="200" height="30">ทดสอบ 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell 3</td><td width="200" height="30">ภาษาไทย 4</td>
</tr>
</table>';

Fpdf::WriteHTML($html);

        Fpdf::Output();
        exit;
    
    }



}
