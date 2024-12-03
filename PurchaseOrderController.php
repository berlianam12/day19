<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrderLine;
use Illuminate\Http\Request;
use Validator;

class PurchaseOrderController extends Controller
{
    public function getProductList() {
        $products = Product::paginate(10);
        return view('admin.products.index', ["products" => $products]);
    }
    public function getProductListShow() {
        return view('admin.products.index');
    }
    public function getProductListEdit() {
        return view('admin.products.index');
    }
    public function getProductListDestroy() {
        return view('admin.products.index');
    }

    public function getPurchaseOrderLineList() {
        $purchaseOrderLines = PurchaseOrderLine::paginate(10);
        return view('admin.purchaseOrderLine.index', ["purchaseOrderLines" => $purchaseOrderLines]);
    }
    public function getPurchaseOrderLineListCreate() {
        $products = Product::all();
        return view('admin.purchaseOrderLine.create', ["products" => $products]);
    }
    public function getPurchaseOrderLineListShow($id) {
        
    }
    public function getPurchaseOrderLineListEdit($id) {
        
    }
    public function getPurchaseOrderLineListDestroy($id) {
        
    }
    public function postPurchaseOrderLineListUpdate($id) {
        
    }
    public function postPurchaseOrderLineListInsert(Request $request, PurchaseOrderLine $purchaseOrderLine) {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required'
        ]);
        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());
        $purchaseOrderLine->product_id = $request->post('product');
        $purchaseOrderLine->qty = $request->post('qty');
        $purchaseOrderLine->price = $request->post('price');
        $purchaseOrderLine->discount = $request->post('discount');
        $purchaseOrderLine->total = (int)$request->post('qty') * (int)$request->post('price') - ((int)$request->post('discount') / 100 * (int)$request->post('price'));
        $purchaseOrderLine->created_at = new \DateTime();
        $purchaseOrderLine->updated_at = new \DateTime();
        return redirect()->intended(route('admin.purchase.order.lines'));
    }
}
