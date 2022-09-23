<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\CareRecord;
use App\Models\User;

use Illuminate\Pagination\Paginator;

use PDF;

class PDFController extends Controller
{
  private $customer;
  private $records;

  public function __construct(){
    $this -> User = new User();
    $this -> CareRecord = new CareRecord();
    $this -> Customer = new Customer();
  }

  public function index(Request $request){
  $id=$request['id'];
  $customer= $this -> Customer ->getCustomerById($id);
  $records= $this -> CareRecord ->findRecordsById($id);
  $date=date("Y-m-d H:i:s");

  $pdf = PDF::loadView('view_PDF',compact('customer','records','date'));
  return $pdf->stream();

}
}
