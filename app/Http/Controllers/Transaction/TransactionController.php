<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
	private $transactionService;
	private $transactions;

	/**
	 * TransactionController constructor.
	 * @param TransactionService $transactionService
	 */
	public function __construct(TransactionService $transactionService )
	{
		$this->transactionService = $transactionService;
		$this->transactions = $transactionService->getTransactions();
	}

	/**
	 * @return JsonResponse
	 * getting all transactions
	 */
	public function index()
	{
		return response()->json(['data' => $this->transactions['data'], 'meta' => ['headers' => $this->transactions['headers'] ] ]);
	}

	/**
	 * @param TransactionStoreRequest $request
	 * @return JsonResponse
	 * stores a transaction
	 */
	public function store(TransactionStoreRequest $request )
	{
		array_push($this->transactions['data'], $request->all());

		$this->createTransaction($this->transactions['data']);

		return successResponse('transaction_created');
	}

	/**
	 * @param TransactionStoreRequest $request
	 * @param $name
	 * @return JsonResponse
	 * example for a transaction edit, will search against transactions first and last names and edit it
	 */
	public function update(TransactionStoreRequest $request, $name)
	{

		foreach ( $this->transactions['data'] as $id => $record ) {

			if ( $record[2] == $name || $record[3] == $name ) {
				$this->transactionService->updateTransaction($id, $request);

				return successResponse('transaction_updated');
			}
		}

		return errorResponse('record_not_found', 404);
	}

	/**
	 * @param $name
	 * @return JsonResponse
	 * example for a search, will search against transactions first and last names
	 */
	public function show($name)
	{
		foreach ( $this->transactions['data'] as $record ) {

			if ( $record[2] == $name || $record[3] == $name ) {
				return response()->json(['data' => $record]);
			}
		}

		return errorResponse('record_not_found', 404);
	}
}
