<?php

namespace App\Http\Controllers;

use App\Messages;
use App\Type;
use App\User;
use http\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data['messages'] = Messages::active()->where('recipient_id', auth()->id())->get();
        return view('messages.index', $data);
    }
    public function show($id){
        $message = Messages::find($id);
        if($message->status != 0){
            $message->status = 0;
            $message->save();
        }
        $data['message'] = $message;
        return view('messages.single', $data);
    }

    public function create()
    {
        $data['messages'] = Messages::all();
        $data['recipients'] = User::all();
        $data['types'] = Type::all();
        return view('messages.create', $data);

    }

    public function store(Request $request)
    {
        $message = new Messages();
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->status = 1;
        $message->active = 1;
        $message->sender_id = auth()->id();
        $message->recipient_id = $request->recipient_id;
        $message->type_id = $request->type;
        $message->save();
        return redirect()->back()->with('message', 'Zinute sukurta');
    }

    public function destroy($id)
    {

        $message = Messages::find($id);

        $message-> active = 0;
        $message ->save();
    }
}
