<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $users = User::all();
        $roles = Role::all();
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('pay', compact('transactions', 'users', 'roles'));
    }

    public function topUp(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $request->validate([
            'saldo' => 'required|numeric|min:5000',
        ], [
            'saldo.min' => 'Saldo harus minimal Rp 5000.',
        ]);
        

        DB::transaction(function () use ($request) {
            Transaction::create([
                'user_id' => Auth::id(),
                'type' => 'top_up',
                'saldo' => $request->saldo,
                'status' => 'Pending',
            ]);
        });

        return back()->with('success', 'Permintaan top-up berhasil diajukan.');
    }

    public function transfer(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $request->validate([
            'recipient_id' => 'required|exists:users,id|different:' . Auth::id(),
            'saldo' => 'required|numeric|min:5000',
        ], [
            'recipient_id.required' => 'Penerima harus dipilih.',
            'recipient_id.exists' => 'Penerima yang dipilih tidak valid.',
            'recipient_id.different' => 'Penerima tidak boleh sama dengan pengguna yang sedang login.',
            'saldo.min' => 'Saldo harus minimal Rp 5000.',
        ]);
        

        $sender = Auth::user();
        $recipient = User::findOrFail($request->recipient_id);

        if (in_array($recipient->role_id, [1, 2])) {
            return back()->withErrors(['recipient' => 'ID penerima yang dipilih tidak valid.']);
        }

        if ($sender->id == $recipient->id) {
            return back()->withErrors(['recipient' => 'ID penerima yang dipilih tidak valid.']);
        }

        if ($sender->saldo < $request->saldo) {
            return back()->withErrors(['saldo' => 'Saldo tidak cukup.']);
        }

        DB::transaction(function () use ($request, $sender, $recipient) {
            Transaction::create([
                'user_id' => $sender->id,
                'type' => 'transfer',
                'saldo' => $request->saldo,
                'recipient_id' => $request->recipient_id,
                'status' => 'Approved',
            ]);

            $sender->saldo -= $request->saldo;
            $sender->save();

            $recipient->saldo += $request->saldo;
            $recipient->save();
        });

        return back()->with('success', 'Transfer berhasil.');
    }

    public function withdraw(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $request->validate([
            'saldo' => 'required|numeric|min:5000',
        ], [
            'saldo.min' => 'Saldo harus minimal Rp 5000.',
        ]);

        $user = Auth::user();

        if ($user->saldo < $request->saldo) {
            return back()->withErrors(['saldo' => 'Saldo tidak cukup.']);
        }

        DB::transaction(function () use ($request, $user) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'tunai',
                'saldo' => $request->saldo,
                'status' => 'Pending',
            ]);
        });

        return back()->with('success', 'Permintaan penarikan berhasil diajukan.');
    }

    public function bankMiniTopUp(Request $request)
    {
        if (!Auth::check() || Auth::user()->role_id !== 2) {
            return redirect()->route('login')->withErrors('Akses tidak sah.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saldo' => 'required|numeric|min:1',
        ]);

        $user = User::findOrFail($request->user_id);

        if (in_array($user->role_id, [1, 2])) {
            return back()->withErrors(['user_id' => 'ID penerima yang dipilih tidak valid.']);
        }

        DB::transaction(function () use ($request, $user) {
            $user->saldo += $request->saldo;
            $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'top_up',
                'saldo' => $request->saldo,
                'status' => 'Approved',
            ]);
        });

        return back()->with('success', 'Saldo berhasil ditambahkan ke pengguna.');
    }

    public function bankMiniWithdraw(Request $request)
    {
        if (!Auth::check() || Auth::user()->role_id !== 2) {
            return redirect()->route('login')->withErrors('Akses tidak sah.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saldo' => 'required|numeric|min:1',
        ]);

        $user = User::findOrFail($request->user_id);

        if (in_array($user->role_id, [1, 2])) {
            return back()->withErrors(['user_id' => 'ID penerima yang dipilih tidak valid.']);
        }

        if ($user->saldo < $request->saldo) {
            return back()->withErrors(['saldo' => 'Saldo pengguna tidak mencukupi.']);
        }

        DB::transaction(function () use ($request, $user) {
            $user->saldo -= $request->saldo;
            $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'tunai',
                'saldo' => $request->saldo,
                'status' => 'Approved',
            ]);
        });

        return back()->with('success', 'Penarikan saldo dari pengguna berhasil.');
    }

    public function approvals()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $users = User::all();
        $roles = Role::all();
        $transactions = Transaction::where('status', 'Pending')->latest()->get();
        return view('approvals', compact('transactions', 'users', 'roles'));
    }

    public function approve($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $transaction = Transaction::findOrFail($id);

        if ($transaction->type === 'top_up') {
            $user = User::findOrFail($transaction->user_id);

            DB::transaction(function () use ($transaction, $user) {
                $user->saldo += $transaction->saldo;
                $user->save();
                $transaction->update(['status' => 'Approved']);
            });

            return back()->with('success', 'Transaksi top-up disetujui.');
        }

        if ($transaction->type === 'tunai') {
            $user = User::findOrFail($transaction->user_id);

            DB::transaction(function () use ($transaction, $user) {
                $user->saldo -= $transaction->saldo;
                $user->save();
                $transaction->update(['status' => 'Approved']);
            });

            return back()->with('success', 'Penarikan disetujui.');
        }

        return back()->withErrors(['error' => 'Jenis transaksi ini tidak memerlukan persetujuan.']);
    }

    public function reject($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan masuk terlebih dahulu.');
        }

        $transaction = Transaction::findOrFail($id);

        DB::transaction(function () use ($transaction) {
            $transaction->update(['status' => 'Rejected']);
        });

        return back()->with('success', 'Transaksi ditolak.');
    }

    public function getRecipientName($id)
    {
        $user = User::find($id);

        if ($user) {
            if (in_array($user->role_id, [1, 2])) {
                return response()->json(['name' => 'Tidak ada User']);
            }
            return response()->json(['name' => $user->name]);
        }

        return response()->json(['name' => null]);
    }

}
 