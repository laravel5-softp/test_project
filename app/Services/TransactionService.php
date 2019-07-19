<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService {

	/**
	 * @return mixed
	 * gets all transactions
	 */
	public function getTransactions()
	{
		return Transaction::GetTransactions();
	}

	/**
	 * @param $transactions
	 * @return mixed
	 * create a new transaction
	 */
	public function createTransaction($transactions)
	{
		return Transaction::storeTransaction($transactions);
	}

	/**
	 * @param $id
	 * @param $request
	 * @return bool
	 * updates a record s
	 */
	public function updateTransaction($id, $request)
	{
		return (new Transaction)->updateTransaction($id, $request);
	}

}