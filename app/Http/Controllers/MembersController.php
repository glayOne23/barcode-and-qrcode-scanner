<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{

    public function index()
    {
        $members = Member::all();
        return view('member.index', compact('members'));
    }
    

    public function create()
    {
        // return view('member.create');
    }
    

    public function import(Request $request)
    {
        $errors = $request->validate([
            'file' => 'required|mimes:ods,xlsx, xls',
        ]);
        
        Excel::import(new MembersImport,request()->file('file'));
           
        return redirect('members/');
    }
    

    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(Member $member)
    {
        return view('member.edit', compact('member'));
    }

    
    public function update(Request $request, Member $member)
    {
        $errors = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'email' => 'required | email',
        ]);

        $temp_data = $member->data;
        $temp_data['name'] = request('name');
        $temp_data['status'] = request('status');
        $temp_data['email'] = request('email');

        $member->update([
            'data' => $temp_data,
        ]);

        return redirect('members/');
    }


    public function destroy(Member $member)
    {
        // delete barcode image
        $image_path = "barcode/".strtolower($member->data['id']).".png"; 
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $member->delete();
        
        return redirect('members/');
    }
}
