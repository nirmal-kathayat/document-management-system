<?php

namespace App\Http\Controllers;
use DataTables;
use App\Repository\UserRepository;
class LeadershipBoardController extends Controller
{
	private $repo;
	public function __construct(UserRepository $repo){
		$this->repo = $repo;
	}
    public function index(){
    	try {
    		 if (request()->ajax()) {
                $data = $this->repo->get([
                	'isLeadershipBoard' => true
               	]);
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
    		return view('leadership.index');
    	} catch (Exception $e) {
    		return redirect()->back()->with(['message' => 'Somthing were wrong','type'=>'error']);
    	}
    }
}
