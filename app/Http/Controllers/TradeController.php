<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Http\Controllers\ApiController;

/**
 *
 */
class TradeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $wallets = $user->wallets;
        $userName = auth()->user();
        $search = $request->input('search');

        $users = User::where('id', '!=', $userName->id)
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', '%' . $search . '%');
            })
            ->get();

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

        return view('trade', compact('users', 'userName', 'recipient', 'messages', 'wallets'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    public function wireTransfer(Request $request)
    {
        $request->validate([
            'targetname' => 'required|exists:users,username',
            'waddress' => 'required|exists:wallets,address',
            'mywallet' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = auth()->user();
        $senderWallet = $user->wallets()->where('wallets.id', $request->mywallet)->firstOrFail();

        $targetUser = User::where('username', $request->targetname)->firstOrFail();
        $receiverWallet = $targetUser->wallets()->where('address', $request->waddress)->first();

        $usdAmount = $request->amount;

        $api = new ApiController();

        try {
            $amountToDeduct = $api->convertUsdToCrypto($usdAmount, $senderWallet->type);
            $amountToCredit = $api->convertUsdToCrypto($usdAmount, $receiverWallet->type);
        } catch (\Exception $e) {
            return back()->withErrors(['amount' => 'Conversion error: ' . $e->getMessage()]);
        }

        if ($senderWallet->pivot->balance < $amountToDeduct) {
            return back()->withErrors(['amount' => 'Insufficient balance in your wallet.']);
        }

        $user->wallets()->updateExistingPivot($senderWallet->id, [
            'balance' => $senderWallet->pivot->balance - $amountToDeduct,
        ]);

        $targetUser->wallets()->updateExistingPivot($receiverWallet->id, [
            'balance' => $receiverWallet->pivot->balance + $amountToCredit,
        ]);

        return back()->with('success', "Transfer to {$targetUser->username} completed successfully."
        );
    }
}
