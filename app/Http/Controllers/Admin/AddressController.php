<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Repositories\AddressRepositoryInterface;
use App\Models\Transformations\AddressTransformable;
use App\Repositories\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use AddressTransformable;

    private $addressRepo;
    private $customerRepo;

    public function __construct(
        AddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->addressRepo = $addressRepository;
        $this->customerRepo = $customerRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->addressRepo->listAddress('created_at', 'desc');

        $addresses = $list->map(function (Address $address) {
            return $this->transformAddress($address);
        })->all();

        return view('admin.addresses.list', ['addresses' => $this->addressRepo->paginateArrayResults($addresses)]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->customerRepo->listCustomers();

        return view('admin.addresses.create', [
            'customers' => $customers
        ]);
    }

    /**
     * @param  CreateAddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAddressRequest $request)
    {
        $this->addressRepo->createAddress($request->except('_token', '_method'));

        $request->session()->flash('message', 'Creation successful');

        return redirect()->route('admin.addresses.index');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('admin.addresses.show', ['address' => $this->addressRepo->findAddressById($id)]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $address = $this->addressRepo->findAddressById($id);
        $addressRepo = new AddressRepository($address);
        $customer = $addressRepo->findCustomer();

        return view('admin.addresses.edit', [
            'address' => $address,
            'customers' => $this->customerRepo->listCustomers(),
            'customerId' => $customer->id
        ]);
    }

    /**
     * @param  UpdateAddressRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $address = $this->addressRepo->findAddressById($id);
        $update = new AddressRepository($address);
        $update->updateAddress($request->except('_method', '_token'));

        $request->session()->flash('message', 'Update successful');

        return redirect()->route('admin.addresses.edit', $id);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = $this->addressRepo->findAddressById($id);
        $delete = new AddressRepository($address);
        
        $delete->deleteAddress();
        request()->session()->flash('message', 'Delete successful');

        return redirect()->route('admin.addresses.index');
    }
}
