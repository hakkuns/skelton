<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\OrderStatusRepositoryInterface;
use App\Repositories\OrderStatusRepository;
use App\Http\Requests\CreateOrderStatusRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    private $orderStatuses;


    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatuses = $orderStatusRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order-statuses.list', ['orderStatuses' => $this->orderStatuses->listOrderStatuses()]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order-statuses.create');
    }

    /**
     * @param  CreateOrderStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderStatusRequest $request)
    {
        $this->orderStatuses->createOrderStatus($request->except('_token', '_method'));
        $request->session()->flash('message', 'Create successful');
        return redirect()->route('admin.order-statuses.index');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.order-statuses.edit', ['orderStatus' => $this->orderStatuses->findOrderStatusById($id)]);
    }

    /**
     * @param  UpdateOrderStatusRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStatusRequest $request, int $id)
    {
        $orderStatus = $this->orderStatuses->findOrderStatusById($id);

        $update = new OrderStatusRepository($orderStatus);
        $update->updateOrderStatus($request->all());

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.order-statuses.edit', $id);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->orderStatuses->findOrderStatusById($id)->delete();

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.order-statuses.index');
    }
}
