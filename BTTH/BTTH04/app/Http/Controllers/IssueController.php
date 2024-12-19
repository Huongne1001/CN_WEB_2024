<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Issue;

use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $issues = Issue::with('computer')->orderBy('id', 'desc')->paginate(10);
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Issue::create($request->all());
        return redirect()->route('issues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Lấy thông tin của vấn đề dựa vào ID
        $issue = Issue::findOrFail($id);
    
        // Lấy danh sách các máy tính để hiển thị trong dropdown
        $computers = Computer::all();
    
        // Trả về view chỉnh sửa với dữ liệu
        return view('issues.edit', compact('issue', 'computers'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        $issue->update($request->all());
        return redirect()->route('issues.index');
    }

    /**
     * Remove the specified resource from storage.
     */    
    public function destroy(Issue $issue)
    {
        if ($issue->delete()) {
            return redirect()->route('issues.index');
        }
    }
}
