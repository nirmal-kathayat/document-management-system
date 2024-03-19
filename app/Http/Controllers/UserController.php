<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repository\UserRepository;
use Exception;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $data = $this->repo->getAll();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
            return view('admin.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function create()
    {
        try {
            return view('admin.form');
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
    public function store(UserRequest $request)
    {
        // dd($request->all());
        try {
            $this->repo->store($request->validated());
            return redirect()->route('admin.user')->with(['message' => 'Users created successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->repo->find($id);
            return view('admin.form')->with(['user' => $user]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $this->repo->update($request->validated(), $id);
            return redirect()->route('admin.user')->with(['message' => 'Users updated successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function delete($id)
    {
        try {
            $this->repo->delete($id);
            return redirect()->back()->with(['message' => 'Users deleted successfully!', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
}
