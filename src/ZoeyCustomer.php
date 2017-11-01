<?php

namespace Cosmicvibes\Zoeylaravel;

class ZoeyCustomer extends Zoey
{

    public $entity_id;
    public $name;
    public $firstname;
    public $lastname;
    public $email;

    public $billing_address;
    public $shipping_address;

    public $created_at;
    public $created_in;
    public $group_id;

    /**
     * ZoeyOrder constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function load($entity_id, $website_id) {

        $tmp_customer = $this->client->get('/api/rest/customers'
                . '?filter[0][attribute]=website_id&filter[0][eq][0]=' . $website_id
                . '&filter[1][attribute]=entity_id&filter[1][eq][1]=' . $entity_id
            )->send()->json();

        $customer = $tmp_customer[key($tmp_customer)];

        $this->entity_id    = $customer['entity_id'];
        $this->firstname    = $customer['firstname'];
        $this->lastname     = $customer['lastname'];
        $this->name         = trim($this->firstname . " " . $this->lastname);
        $this->email        = $customer['email'];

        $this->created_at   = $customer['created_at'];
        $this->created_in   = $customer['created_in'];
        $this->group_id     = $customer['group_id'];

        $addresses = $this->client->get('/api/rest/customers/' . $this->entity_id . '/addresses')->send()->json();

        foreach ($addresses as $address) {
            if ($address['is_default_billing'] === 1) {
                $this->billing_address['entity_id']     = $address['entity_id'];
                $this->billing_address['firstname']     = $address['firstname'];
                $this->billing_address['lastname']      = $address['lastname'];
                $this->billing_address['street']        = $address['street'][0];
                $this->billing_address['street2']       = $address['street'][1];
                $this->billing_address['region']        = $address['region'];
                $this->billing_address['city']          = $address['city'];
                $this->billing_address['postcode']      = $address['postcode'];
                $this->billing_address['country_id']    = $address['country_id'];
                $this->billing_address['telephone']     = $address['telephone'];
            }

            if ($address['is_default_shipping'] === 1) {
                $this->shipping_address['entity_id']     = $address['entity_id'];
                $this->shipping_address['firstname']     = $address['firstname'];
                $this->shipping_address['lastname']      = $address['lastname'];
                $this->shipping_address['street']        = $address['street'][0];
                $this->shipping_address['street2']       = $address['street'][1];
                $this->shipping_address['region']        = $address['region'];
                $this->shipping_address['city']          = $address['city'];
                $this->shipping_address['postcode']      = $address['postcode'];
                $this->shipping_address['country_id']    = $address['country_id'];
                $this->shipping_address['telephone']     = $address['telephone'];
            }

        }

    }




}
