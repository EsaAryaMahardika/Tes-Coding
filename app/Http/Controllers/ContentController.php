<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function content(){
        $content = Content::all();
        return view('content', compact('content'));
    }
    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        Content::create([
            'title' => $request->title,
            'content' => $request->body,
            'username' => $this->user->username,
            'date' => Carbon::now()
        ]);
        return redirect('/content')->with('success', 'Content created successfully.');
    }
    public function edit($id){
        $content = Content::findOrFail($id);
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $content->update([
            'title' => $data['title'],
            'content' => $data['body']
        ]);
        return redirect('/content')->with('success', 'Content updated successfully.');
    }
    public function delete($id){
        $content = Content::findOrFail($id);
        $content->delete();
        return redirect('/content')->with('success', 'Content deleted successfully.');
    }
}
