<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Repositories\AddressRepository;
use App\Repositories\AddressRepositoryInterface;

class CustomerAddressController extends Controller
{
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepo;

    /**
     * @param AddressRepositoryInterface  $addressRepository
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository
    ) {
        $this->addressRepo = $addressRepository;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {

        return redirect()->route('accounts', ['tab' => 'address']);
    }

    /**
     * @param  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $customer = auth()->user();

        return view('front.customers.addresses.create', [
            'customer' => $customer
        ]);
    }

    /**
     * @param CreateAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAddressRequest $request)
    {
        $request['customer_id'] = auth()->user()->id;

        $this->addressRepo->createAddress($request->except('_token', '_method'));

        return redirect()->route('account')
            ->with('message', '住所の登録に成功しました');
    }

    /**
     * @param $addressId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

        return view('front.customers.addresses.edit', [
            'customer' => auth()->user(),
            'address' => $address,
        ]);
    }

    /**
     * @param UpdateAddressRequest $request
     * @param $addressId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAddressRequest $request, $customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

        $request = $request->except('_token', '_method');
        $request['customer_id'] = auth()->user()->id;

        $addressRepo = new AddressRepository($address);
        $addressRepo->updateAddress($request);

        return redirect()->route('account')
            ->with('message', '住所の更新に成功しました');
    }

    /**
     * @param $addressId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

       if ($address->orders()->exists()) {
             $address->status=0;
             $address->save();
       }
       else {
             $address->delete();
       }
        return redirect()->route('account')
            ->with('message', '住所の削除に成功しました');
    }
}
