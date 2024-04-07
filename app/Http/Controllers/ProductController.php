<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try {
            $products = $this->productRepository->all();
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch products.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]);
            $product = $this->productRepository->create($validatedData);
            return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to create product.'.$e], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productRepository->find($id);
            return response()->json($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch product.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = $this->productRepository->find($id);
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]);

            $product = $this->productRepository->update($product, $validatedData);
            return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to update product.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->productRepository->find($id);
            $this->productRepository->delete($product);
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete product.'], 500);
        }
    }
}
