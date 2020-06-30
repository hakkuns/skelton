<?php

namespace App\Models\Transformations;

use App\Models\Address;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

trait AddressTransformable
{
    /**
     * Transform the address
     *
     * @param Address $address
     *
     * @return Address
     */
    public function transformAddress(Address $address)
    {
        $new_address = new Address;
        $new_address->id = $address->id;
        $new_address->alias = $address->alias;
        $new_address->address_1 = $address->address_1;
        $new_address->address_2 = $address->address_2;
        $new_address->address_3 = $address->address_3;
        $new_address->zip = $address->zip;

        $customerRepo = new CustomerRepository(new Customer);
        $customer = $customerRepo->findCustomerById($address->customer_id);
        $new_address->customer = $customer->name;
        $new_address->status = $address->status;
        $new_address->customer_id = $address->customer_id;
        return $obj;
    }
}
