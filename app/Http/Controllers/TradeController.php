<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index(Request $request)
    {
        $userName = auth()->user();
        $users = User::where('id', '!=', $userName->id)->get();
        $recipientId = $request->query('to');
        $recipient = $recipientId ? User::find($recipientId) : null;

        $messages = collect();
        if ($recipient) {
            $messages = Message::where(function ($q) use ($userName, $recipient) {
                $q->where('sender_id', $userName->id)
                    ->where('recipient_id', $recipient->id);
            })->orWhere(function ($q) use ($userName, $recipient) {
                $q->where('sender_id', $recipient->id)
                    ->where('recipient_id', $userName->id);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('trade', compact('users', 'userName', 'recipient', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'body' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'body' => $request->body,
        ]);

        return redirect()->route('trade.page', ['to' => $request->recipient_id]);
    }
}
