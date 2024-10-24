<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\MarkAsPaidRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{

	protected OrderService $orderService;

	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}
	/**
     * Display a listing of the resource.
     */
	public function index(): AnonymousResourceCollection
	{
		$query = Order::query();

		$orders = $query->orderBy('created_at', 'desc')->get();

		return OrderResource::collection($orders);
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): OrderResource
	{
        $data = $request->validated();

		$order = $this->orderService->createOrder($data);

		return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
	{
        return OrderResource::make($order);
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
    public function update(UpdateRequest $request, Order $order): OrderResource
	{
        $updatedOrder = $this->orderService->updateOrder($order, $request->validated());

		return new OrderResource($updatedOrder);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
	{
        $this->orderService->deleteOrder($order);

		return response()->json(['message' => 'Order deleted']);
    }

	public function markAsPaid(Order $order, MarkAsPaidRequest $request): JsonResponse
	{
		$order->update(['status' => $request->validated()['status']]);

		return response()->json([
			'message' => 'Order marked as paid successfully.',
			'order' => $order
		], 200);
	}

	public function userOrders(Request $request): AnonymousResourceCollection
	{
		$orders = $request->user()->orders()->with('paymentMethod')->get();
		return OrderResource::collection($orders);
	}

}
