<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class TransactionController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $transactions = Transaction::all();
        return view('admin.page.transaction.index',
            [
                'transactions' => $transactions
            ]
        );
    }

    public function searchTransactions(Request $request): View|Factory|Application
    {
        $status = $request->input('status');

        $transactions = Transaction::query()
            ->when($status, function ($queryBuilder) use ($status) {
                $queryBuilder->where('status', $status);
            })
            ->get();
        return view('admin.page.transaction.search-results', compact('transactions'));
    }

    public function updateStatus(Request $request): RedirectResponse
    {
        try {
            $input = $request->all();
            $transaction = Transaction::find($input['transaction_id']);
            $transaction->status = $input['status'];
            $transaction->notes = $input['notes'];
            $transaction->save();
            return redirect()->back()->with('success', 'Cập nhật trạng thái giao dịch thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
