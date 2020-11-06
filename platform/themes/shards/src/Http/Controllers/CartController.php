<?php

namespace Theme\Shards\Http\Controllers;

use Illuminate\Routing\Controller;
use Theme;
use Botble\Catalog\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cart as ShoppingCart;
use Botble\Order\Models\Order;
use SeoHelper;



class CartController extends Controller
{

    /**
     * @return \Response
     */


    public function index()
    {
        SeoHelper::setTitle('Beefurni - Cart')->setDescription('Beefurni - Page Cart');
        $countries = DB::table('countries')->whereIn('name', ['Canada', 'United States', 'Mexico'])->get();
        return Theme::scope('cart', ['countries' => $countries])->render();
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $product = Product::where('id', $id)->get()->toArray();

        if ($product[0]['discount_price']) {
            ShoppingCart::add([
                'id' => $product[0]['id'],
                'name' => $product[0]['name'],
                'price' => $product[0]['discount_price'],
                'attributes' => array(
                    'image' => $product[0]['image'],
                ),
                'quantity' => $qty,

            ]);
        } else {
            ShoppingCart::add([
                'id' => $product[0]['id'],
                'name' => $product[0]['name'],
                'price' => $product[0]['price'],
                'attributes' => array(
                    'image' => $product[0]['image'],
                ),
                'quantity' => $qty,

            ]);
        }
        $cart = ShoppingCart::getContent();
        $numberCart = count($cart);
        $data = [
            'data' => $cart,
            'numberCart' => $numberCart,
            'message' => 'Order Success'
        ];
        return json_encode($data);
    }

    public function updateCart(Request $request)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $cart = ShoppingCart::getContent();
        $data = [];
        if (!empty($id) && !empty($qty)) {
            ShoppingCart::update($id, [
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty
                )
            ]);
            $subTotal = ShoppingCart::getSubTotal();

            $data = [
                'subTotal' => $subTotal,
                'data' => $cart,
                'message' => 'Update Success'
            ];
            return json_encode($data);
        }
        $data = [
            'message' => 'An error has occurred'
        ];
        return json_encode($data);
    }

    public function removeCart(Request $request)
    {
        $id = $request->input('id');
        $data = [];
        if ($id) {
            ShoppingCart::remove($id);
            $cart = ShoppingCart::getContent();
            $data = [
                'data' => $cart,
                'numberCart' => count($cart),
                'subTotalNoFormat' => ShoppingCart::getSubTotal(),
                'subTotal' => ShoppingCart::getSubTotal(),
                'message' => 'Product deleted from cart',
            ];
            return json_encode($data);
        }
        $data = [
            'message' => 'An error has occurred'
        ];
        return json_encode($data);
    }

    public function getStates(Request $request)
    {
        $id_country = $request->input('idCountry');
        $states = DB::table('states')->where('country_id', $id_country)->get();
        return json_encode($states);
    }

    public function getDistrict(Request $request)
    {
        $id_province = $request->input('idProvice');
        $states = DB::table('cities')->where('state_id', $id_province)->get();
        return $states;
    }

    public function checkout(Request $request)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $country = $request->input('country');
        $province = $request->input('province');
        $district = $request->input('district');
        $address = $request->input('address');
        $time = $request->input('time_to_delivery');
        $payment = $request->input('payment_type');
        $description = $request->input('description');
        $totalPrice = $request->input('totalPrice');

        $cart = ShoppingCart::getContent();
        $data = [];
        if (!empty($cart)) {

            $country_name = DB::table('countries')->where('id', $country)->first();
            $district_name = DB::table('cities')->where('id', $district)->first();
            $province_name = DB::table('states')->where('id', $province)->first();

            foreach ($cart as $item) {
                $newData = [
                    'product_id' => $item['id'],
                    'Gender' => ($gender == 0) ? 'Male' : 'Female',
                    'qty' => $item['quantity'],
                    'customer_name' => $name,
                    'customer_phone' => $phone,
                    'customer_email' => $email,
                    'Country' => $country_name->name,
                    'District' => $district_name->name,
                    'Province' => $province_name->name,
                    'Address_Detail' => $address,
                    'time_to_delivery' => $time,
                    'payment_type' => $payment,
                    'content' => $description
                ];
                array_push($data, $newData);
            }
            $insert = Order::insert($data);
            if ($insert) {
                ShoppingCart::clear();
                return redirect('cart')->with('success', 'Order success');
            }
            return redirect('cart')->with('errors', 'Order failed');
        }
    }
}