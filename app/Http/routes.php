<?php  
// Route::get('pdf', function () {
//     $pdf = new PDF();    
//     $pdf->load_html($html);
//     $pdf->render();
//     $dpdf = $pdf->output();
//     return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
   
//     // $pdf = PDF::loadView('pdf');
//     // return $pdf->stream('archivo.pdf');
// });
// Route::get('p', function () {
//     return View('pdf');
// });

Route::get('st', function(){
    return view('pdf');
});

Route::get('/ooo', function () {

    Fpdf::AddPage();
    Fpdf::SetFont('Courier', 'B', 18);
    Fpdf::Cell(50, 25, 'Hello World!');
    Fpdf::Output();
     exit;

});

Route::get('/ppp', function () {

    Fpdf::AddPage();
    Fpdf::SetFont('Courier', 'B', 18);
    Fpdf::Cell(50, 25, 'Hello World!');
    Fpdf::Output();

});

Route::get('/aaa', function ( ) {
$fpdf=Codedge\Fpdf\Fpdf\FPDF;
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(40,10,'Hello World!');
        $fpdf->Output();
        exit;

});

Route::get('/bbb', function (Codedge\Fpdf\Fpdf\FPDF $fpdf) {

        $fpdf->AddPage();
        $fpdf->AddFont('angsa','','angsa.php');
        $fpdf->SetFont('angsa','',36);
        $fpdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'พิมพ์ให้อยู่ตรงกลาง' ) , 0 , 1 , 'C' );
        // $fpdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'พิมพ์ให้อยู่ตรงกลาง' ) , 0 , 1 , 'C' );
        $fpdf->Output();
        exit;

});

// Route::get('pdfff', function(){
//     $fpdf = new Fpdf();
//         $fpdf->AddPage();
//         $fpdf->SetFont('Arial','B',16);
//         $fpdf->Cell(40,10,'Hello World!');
//         $fpdf->Output();
//         exit;

// });
Route::get('iii', function () {
    $pdf = PDF::loadView('pdf');
    return $pdf->stream('archivo.pdf');
});


Route::get('/', 'GuestbookController@reindex' );
// ========== Login and validation ============
Route::group(['middleware' => ['web']], function () {    
    Route::auth();
    Route::get('/home', 'GuestbookController@reindex');
    Route::get('guestbook', 'GuestbookController@reindex' );
    Route::get('guestbook/index', 'GuestbookController@index' );
    Route::post('guestbook/search', 'GuestbookController@search');
    Route::post('guestbook/addComment','GuestbookController@addComment');
    Route::get('guestbook/delete/{id}','GuestbookController@delete');
    Route::get('guestbook/edit/{id}','GuestbookController@editComment');
    Route::post('guestbook/saveComment/{id}','GuestbookController@saveComment');
 	Route::get('guestbook/searchTag/{id}', 'GuestbookController@searchTag');
 	Route::get('guestbook/contact', 'GuestbookController@contact');
 	Route::post('guestbook/submitEmail', 'GuestbookController@submitEmail');
Route::get('/pdf', 'HomeController@in' );

Route::get('/log', 'HomeController@getlog' );
Route::post('/log', 'HomeController@postlog' );
});

 