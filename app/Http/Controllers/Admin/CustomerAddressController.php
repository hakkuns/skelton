<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\AddressRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Http\Controllers\Controller;

class CustomerAddressController extends Controller
{
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepo;
   
    /**
     * CustomerAddressController constructor.
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository
    ) {
        $this->addressRepo = $addressRepository;
    }

    /**
     * @param int $customerId
     * @param int $addressId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $customerId, int $addressId)
    {
        return view('admin.customers.address.show', [
            'address' => $this->addressRepo->findAddressById($addressId),
            'customerId' => $customerId
        ]);
    }

    /**
     * @param int $customerId
     * @param int $addressId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $customerId, int $addressId)
    {
        return view('admin.customers.address.edit', [
            'address' => $this->addressRepo->findAddressById($addressId),
            'customerId' => $customerId
        ]);
    }
}
