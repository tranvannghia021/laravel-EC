<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Product_detail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartService
{

    public function create($request)
    {
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product-id');

        if ($qty <= 0 || $product_id <= 0) {
            //  Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
                
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }
    public function update($request){
        Session::put('carts', $request->input('num_product'));
        return true;
    }
    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return [];
        }
        $product_id = array_keys($carts);
        /* run sql - ORM */

        return Product::join('image_products', 'image_products.product_id', '=', 'products.id')
            ->join('images', 'images.id', '=', 'image_products.image_id')
            ->join('group_products', 'group_products.id', '=', 'products.group_id')
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->where('active', 1)
            ->whereIn('products.id', $product_id)
            ->get(['group_products.id as cate_id', 'products.id', 'group_products.name', 'products.name as name_product', 'description', 'price', 'amount', 'active', 'code_color', 'images.img']);
    }
    public function remove($id)
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return false;
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }
    private function addOrder($request)
    {
        $address = $request->input('address') . ', ' . $request->input('calc_shipping_wards') . ', ' . $request->input('calc_shipping_district') . ', ' . $request->input('calc_shipping_provinces');
        try {

            // dd(Session::get('customer_id'));
            return  Orders::create([
                'customer_id' => (int)Session::get('customer_id'),
                'staff_id' => 1,
                'discount_id' => (int)$request->input('discount_id'),
                'discount_value' => (float)$request->input('discount_value'),
                'status' => 1, // chưa thanh toán
                'total_price' => (float)$request->input('total_price'),
                'payment_method_id' => (int)$request->input('payment_method_id'),
                'address' => (string)$address,
            ]);
        } catch (\Exception $err) {
            // Session::flash('error', $err->getMessage());
            return   false;
        }
        return true;
    }
    private function addOrderDetail($order_id, $carts)
    {

        try {

            foreach ($carts as $key => $cart_item) {
                $product_detail = Product_detail::select('price')->where('id', $key)->first();
                OrderDetail::create([
                    'order_id' => $order_id,
                    'product_id' => $key,
                    'amount' => $cart_item,
                    'price' => $product_detail->price,
                ]);
            }
        } catch (\Exception $err) {
            //Session::flash('error', $err->getMessage());
            return   false;
        }
        return true;
    }
    public function addCart($request)
    {

        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if (is_null($carts))
                return false;

            /* Thêm Order trước tiên */
            $result_add_order =  $this->addOrder($request);
            /* xử lý created mảng carts */
            //  dd($result_add_order->id);
            $order_id = $result_add_order->id;
            if ($result_add_order) {
                $result_add_order_detail =  $this->addOrderDetail($order_id, $carts);
                if (!$result_add_order_detail) return false;
            } else return false;



            $address = $request->input('address') . ', ' . $request->input('calc_shipping_wards') . ', ' . $request->input('calc_shipping_district') . ', ' . $request->input('calc_shipping_provinces');
            $customer = [
                'email' => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'address' => $address,
            ];
            $order_id=Orders::select('id')->orderByDesc('created_at')->first();

            DB::commit();
            //Session::flash('success', 'Đặt Hàng Thành Công');

            $data = [
                'reset_password' =>false,
                'customer' => $customer,
                'order_id' =>  $order_id->id,
            ];
          

            #Queue

            SendMail::dispatch($data)->delay(now()->addSeconds(5));

           Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }
    protected function infoProductCart($carts, $customer_id)
    {

        $product_id = array_keys($carts);
        $products = Product::select('id', 'name', 'thumb', 'price', 'price_sale')
            ->where('active', 1)
            ->whereIn('id', $product_id)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price,

            ];
        }
        Orders::insert($data);
        return $products;
    }
}
