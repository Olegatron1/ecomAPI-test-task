<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\AddProductsRequest;
use App\Http\Requests\Api\Cart\StoreRequest;
use App\Http\Requests\Api\Cart\UpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{

	protected CartService $cartService;

	public function __construct(CartService $cartService)
	{
		$this->cartService = $cartService;
	}

	/**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
	{
		return CartResource::collection(Cart::all());
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
    public function store(StoreRequest $request): CartResource
	{
        $data = $request->validated();

		$cart = $this->cartService->createCart($data);

		return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): CartResource
	{
		return CartResource::make($cart);
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
    public function update(UpdateRequest $request, Cart $cart): CartResource
	{
		$updatedCart = $this->cartService->updateCart($cart, $request->validated());

		return new CartResource($updatedCart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart): JsonResponse
	{
		$this->cartService->deleteCart($cart);

		return response()->json([
			'message' => 'Cart deleted successfully'
		]);
    }

	public function addProducts(AddProductsRequest $request, Cart $cart): JsonResponse
	{
		$products = $request->validated()['products'];

		// Вызов метода из сервиса для добавления продуктов в корзину
		$this->cartService->addProductsToCart($cart, $products);

		return response()->json(['message' => 'Products added to cart successfully.']);
	}
}
