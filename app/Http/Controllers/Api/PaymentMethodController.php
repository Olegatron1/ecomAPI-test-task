<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentMethod\StoreRequest;
use App\Http\Requests\Api\PaymentMethod\UpdateRequest;
use App\Http\Resources\PaymentMethod\PaymentMethodResource;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentMethodController extends Controller
{

	protected PaymentMethodService $paymentMethodService;

	public function __construct(PaymentMethodService $paymentMethodService)
	{
		$this->paymentMethodService = $paymentMethodService;
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(): AnonymousResourceCollection
	{
		return PaymentMethodResource::collection(PaymentMethod::all());
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreRequest $request): PaymentMethodResource
	{
		$data = $request->validated();

		$paymentMethod = $this->paymentMethodService->createPaymentMethod($data);

		return new PaymentMethodResource($paymentMethod);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(PaymentMethod $paymentMethod): PaymentMethodResource
	{
		return PaymentMethodResource::make($paymentMethod);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateRequest $request, PaymentMethod $paymentMethod): PaymentMethodResource
	{
		$updatedPaymentMethod = $this->paymentMethodService->updatePaymentMethod($paymentMethod, $request->validated());

		return new PaymentMethodResource($updatedPaymentMethod);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PaymentMethod $paymentMethod): JsonResponse
	{
		$this->paymentMethodService->deletePaymentMethod($paymentMethod);

		return response()->json([
			'message' => 'PaymentMethod deleted successfully'
		]);
	}
}
