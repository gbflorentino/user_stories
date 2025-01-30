<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Transaction;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\TransactionsFilteredRequest;

class UserControler extends Controller
{
    public function show(Request $request)
    {
	$user = User::find($request->route()->parameter('id'));

	if(!$user) {
	    $response = [
		'message'=> 'user not found'
	    ];

	    return response()->json($message, 404);
	}

	return response()->json(new UserResource($user), 200);
    }

    public function update(UserRegisterRequest $request)
    {
	// This will hash the password before update the model
	$request['password'] = Hash::make($request['password']);
	auth()->user()->update($request->toArray());
	
	return response()->json($request, 200);
    }

    public function delete(Request $request)
    {
	$user = User::find($request->route()->parameter('id'));
	
	if (!Gate::allows('delete', $user)) {
            return response()->json('Not Allowed', 404);
        }
	
	$user->delete();

	return response()->json(null, 204);
    }

    public function showCategories(Request $request)
    {
	return response()->json(auth()->user()->categories);
    }

    public function showTransactions(Request $request)
    {
	return response()->json(auth()->user()->transactions);
    }

    public function showFilteredTransactions(TransactionsFilteredRequest $request)
    {
	$filter = $request['filter'];
	$filter_type = $request['filter_type'];
	
	if ($filter_type == 'category'){
	    $transactions = Transaction::where('category_id', $filter)->get();
	} elseif ($filter_type == 'user'){
	    $transactions = Transaction::where('user_id', $filter)->get();
	} elseif ($filter_type == 'type'){
	    $transactions = Transaction::where([
		['user_id', $request->route()->parameter('id')],
		['transaction_type', $filter]
	    ])->get();    
	}

	if (!Gate::allows('view', $transactions)) {
            return response()->json('Not Allowed', 404);
        }
	
	return response()->json($transactions, 200);
    }

}
