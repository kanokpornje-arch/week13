<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function about2()
    {
        $name = "Kanokporn Jeamthong";
        $date = "5 กรกฎาคม 2026";

        return view('about2', compact('name', 'date'));
    }

    public function blog2()
    {
        $blog2 = DB::table('blogs')->paginate(1);

        return view('blog2', compact('blog2'));
    }

    public function form()
    {
        return view('form');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'หัวข้อไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณาใส่เนื้อหาบทความ',
            'status.required' => 'กรุณาเลือกสถานะ'
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ];

        DB::table('blogs')->insert($data);

        return redirect()->route('form')
            ->with('success', 'ส่งข้อมูลเรียบร้อย');
    }

    public function delete($id)
    {
        DB::table('blogs')
            ->where('id', $id)
            ->delete();

        return redirect()->route('blog2');
    }

    public function change($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        $data = [
            'status' => $blog->status
        ];
        if ($blog->status == 0) {
            $data = ['status' => 1];
        } else {
            $data = ['status' => 0];

        }
        DB::table('blogs')->where('id', $id)->update($data);
        return redirect('/blog2');
    }

    function edit($id)
    {
        $blog = DB::table("blogs")->where('id', $id)->first();
        return view("edit", compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'หัวข้อไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณาใส่เนื้อหาบทความ',
            'status.required' => 'กรุณาเลือกสถานะ'
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content
        ];
        DB::table('blogs')->where('id', $id)->update($data);
        return redirect('/blog2');
    }
    function __construct()
    {
        $this->middleware('auth');

    }
}