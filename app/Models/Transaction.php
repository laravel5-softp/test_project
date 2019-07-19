<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Transaction extends Model {

	public function scopeGetTransactions( )
	{

		if ( ! Cache::has('transactions.headers') ) {

			$transactions = [];
			$records = getCsvFile('transactions.csv');
			$headers = [];

			while ($csvLine = fgetcsv($records, 1000, ",")) {

				if( empty($headers) ) {
					array_push($headers, $csvLine);
					continue;
				}
				array_push($transactions, $csvLine);
			}

			Cache::put('transactions.headers', $headers, 100);
			Cache::put('transactions.data', $transactions, 100);

			return ['headers' =>  Cache::get('transactions.headers'), 'data' => Cache::get('transactions.data')];
		}

		return ['headers' =>  Cache::get('transactions.headers'), 'data' => Cache::get('transactions.data')];
	}

	/**
	 * @param $transactions
	 * @return bool
	 */
	public function scopeStoreTransaction($transactions)
	{
		Cache::forget('transactions.data');
		Cache::put('transactions.data', $transactions, 100);

		return true;
	}

	/**
	 * @param $id
	 * @param $request
	 * @return bool
	 */
	public function updateTransaction($id, $request)
	{
		$records = Cache::get('transactions.data');
		$records[$id] = $request;

		self::scopeStoreTransaction($records);

		return true;
	}
}