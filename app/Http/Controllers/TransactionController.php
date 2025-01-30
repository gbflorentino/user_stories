<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Category;
use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function register(TransactionRequest $request)
    {
	$category = Category::find($request['category_id']);
	
	$transaction = Transaction::create([
	    'transaction_type' => $request['type'],
	    'amount' => $request['amount'],
	    'user_id' => $request->route()->parameter('user_id'),
	    'category_id' => $category->id
	]);

	return response()->json([
	    'message'=> 'Transaction successfully created'
	], 200);
    }

    public function delete(Request $request)
    {	
	$transaction = Transaction::find($request->route()->parameter('transaction_id'));

	if (! Gate::allows('delete', $transaction)) {
            return response()->json('Not Allowed', 404);
        }
	
	$transaction->delete();

	return response()->json(null, 204);
    }
}
