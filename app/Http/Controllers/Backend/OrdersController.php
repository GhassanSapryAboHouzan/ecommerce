<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTransactions;
use App\Models\ProductCoupon;
use App\Models\User;
use App\Notifications\Backend\Order\OrderChangeStatusNotification;
use App\Services\OmnipayService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /*** Index Function*/
    public function index()
    {
        $title = __('orders.orders');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'manage_orders, show_orders')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $orders = Order::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereOrderStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.orders.index', compact('orders', 'title'));
    }


    /*** Create Function */
    public function create()
    {

    }


    /*** Store Function */
    public function store(Request $request)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'create_orders')) {
            return redirect()->route('admin.index');
        }
    }


    /*** Show Function */
    public function show($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'display_orders')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $order = Order::whereId($id)->first();


        $orderStatusArray = [
            '0' => 'New order',
            '1' => 'Paid',
            '2' => 'Under process',
            '3' => 'Finished',
            '4' => 'Rejected',
            '5' => 'Canceled',
            '6' => 'Refund requested',
            '7' => 'Returned order',
            '8' => 'Refunded',
        ];


        $key = array_search($order->order_status, array_keys($orderStatusArray));
        foreach ($orderStatusArray as $k => $v) {
            if ($k - 1 < $key) {
                unset($orderStatusArray[$k]);
            }
        }

        return view('backend.orders.show', compact('order', 'orderStatusArray'));

    }


    /*** Edit Function*/
    public function edit($id)
    {
        $title = __('orders.order_update');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_orders')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    }


    /*** Update Function */
    public function update(Request $request, $id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'update_orders')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $order = Order::find($id);
        $customer = User::find($order->user_id);

        if ($request->order_status == Order::REFUNDED) {
            /////////////////////////////////////////////////////////////////////
            ///


            $omniPay = new OmnipayService('PayPal_Express');

            $response = $omniPay->refund([
                'amount' => $order->total,
                'transactionReference' => $order->transactions()
                    ->whereTransaction(OrderTransactions::PAYMENT_COMPLETED)->first()->transaction_number,
                'cancelUrl' => $omniPay->getCancelUrl($order->id),
                'returnUrl' => $omniPay->getReturnUrl($order->id),
                'notifyUrl' => $omniPay->getNotifyUrl($order->id),

            ]);

            if ($response->isSuccessful()) {
                $order->update(['order_status' => Order::REFUNDED]);
                $order->transactions()->create([
                    'transaction' => OrderTransactions::REFUNDED,
                    'transaction_number' => $response->getTransactionReference(),
                    'payment_result' => 'success'
                ]);


                ///////////////////////////////////////////////////////////////
                /// notification
                $customer->notify(new OrderChangeStatusNotification($order));

                return back()->with([
                    'message' => __('orders.order_refunded_successfully'),
                    'alert-type' => 'success'
                ]);
            }

            //////////////////////////////////////////////////////////////////////////
            ///
        } else {

            $order = Order::find($id);

            $order->update([
                'order_status' => $request->order_status,
            ]);

            $order->transactions()->create([
                'transaction' => $order->order_status,
                'transaction_number' => '',
                'payment_result' => '',
            ]);

            ///////////////////////////////////////////////////////////////
            /// notification
            $customer->notify(new OrderChangeStatusNotification($order));


            return back()->with([
                'message' => __('orders.order_status_updated_successfully'),
                'alert-type' => 'success'
            ]);
        }


    }


    /*** destroy */
    public function destroy($id)
    {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        if (!auth()->user()->ability('admin', 'delete_orders')) {
            return redirect()->route('admin.index');
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $order = order::findOrFail($id);
        if (!$id || !$order) {
            return redirect()->route('admin.orders.index');
        }
        $order->delete();
        return redirect()->route('admin.orders.index')->with([
            'message' => __('common.delete_success_message'),
            'alert-type' => 'success'
        ]);
    }

}
