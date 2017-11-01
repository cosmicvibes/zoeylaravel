<?php

namespace Cosmicvibes\Zoeylaravel;

class ZoeyOrder extends Zoey
{

    public $entity_id;
    public $status;
    public $coupon_code;
    public $shipping_description;
    public $customer_id;
    public $base_discount_amount;
    public $base_grand_total;
    public $base_shipping_amount;
    public $base_shipping_tax_amount;
    public $base_subtotal;
    public $base_tax_amount;
    public $base_total_paid;
    public $base_total_refunded;
    public $discount_amount;
    public $grand_total;
    public $shipping_amount;
    public $shipping_tax_amount;
    public $store_to_order_rate;
    public $subtotal;
    public $tax_amount;
    public $total_paid;
    public $total_refunded;
    public $base_shipping_discount_amount;
    public $base_subtotal_incl_tax;
    public $base_total_due;
    public $shipping_discount_amount;
    public $subtotal_incl_tax;
    public $total_due;
    public $increment_id;
    public $base_currency_code;
    public $discount_description;
    public $remote_ip;
    public $store_currency_code;
    public $store_name;
    public $created_at;
    public $shipping_incl_tax;
    public $zoey_order_comment;
    public $payment_method;
    public $gift_message_from;
    public $gift_message_to;
    public $gift_message_body;
    public $tax_name;
    public $tax_rate;

    public $billing_address;
    public $shipping_address;

    public $items       = [];
    public $comments    = [];

    /**
     * ZoeyOrder constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function load($increment_id) {

        $tmp_order = $this->client->get('/api/rest/orders'
                . '?filter[0][attribute]=increment_id&filter[0][eq][0]=' . $increment_id
        )->send()->json();

        $order = $tmp_order[key($tmp_order)];

        $this->entity_id			            = $order['entity_id'];
        $this->status				            = $order['status'];
        $this->coupon_code			            = $order['coupon_code'];
        $this->shipping_description		        = $order['shipping_description'];
        $this->customer_id			            = $order['customer_id'];
        $this->base_discount_amount		        = $order['base_discount_amount'];
        $this->base_grand_total			        = $order['base_grand_total'];
        $this->base_shipping_amount		        = $order['base_shipping_amount'];
        $this->base_shipping_tax_amount		    = $order['base_shipping_tax_amount'];
        $this->base_subtotal			        = $order['base_subtotal'];
        $this->base_tax_amount			        = $order['base_tax_amount'];
        $this->base_total_paid			        = $order['base_total_paid'];
        $this->base_total_refunded		        = $order['base_total_refunded'];
        $this->discount_amount			        = $order['discount_amount'];
        $this->grand_total			            = $order['grand_total'];
        $this->shipping_amount			        = $order['shipping_amount'];
        $this->shipping_tax_amount		        = $order['shipping_tax_amount'];
        $this->store_to_order_rate		        = $order['store_to_order_rate'];
        $this->subtotal				            = $order['subtotal'];
        $this->tax_amount			            = $order['tax_amount'];
        $this->total_paid			            = $order['total_paid'];
        $this->total_refunded			        = $order['total_refunded'];
        $this->base_shipping_discount_amount	= $order['base_shipping_discount_amount'];
        $this->base_subtotal_incl_tax		    = $order['base_subtotal_incl_tax'];
        $this->base_total_due			        = $order['base_total_due'];
        $this->shipping_discount_amount		    = $order['shipping_discount_amount'];
        $this->subtotal_incl_tax		        = $order['subtotal_incl_tax'];
        $this->total_due			            = $order['base_currency_code'];
        $this->increment_id			            = $order['increment_id'];
        $this->base_currency_code		        = $order['base_currency_code'];
        $this->discount_description		        = $order['discount_description'];
        $this->remote_ip			            = $order['remote_ip'];
        $this->store_currency_code		        = $order['store_currency_code'];
        $this->store_name			            = $order['store_name'];
        $this->created_at			            = $order['created_at'];
        $this->shipping_incl_tax		        = $order['shipping_incl_tax'];
        $this->zoey_order_comment		        = $order['zoey_order_comment'];
        $this->payment_method			        = $order['payment_method'];
        $this->gift_message_from		        = $order['gift_message_from'];
        $this->gift_message_to			        = $order['gift_message_to'];
        $this->gift_message_body		        = $order['gift_message_body'];
        $this->tax_name				            = $order['tax_name'];
        $this->tax_rate				            = $order['tax_rate'];

        foreach ($order['addresses'] as $address) {
            switch ($address['address_type']) {

                case 'billing' :
                    $this->billing_address['region']        = $address['region'];
                    $this->billing_address['postcode']      = $address['postcode'];
                    $this->billing_address['street']        = $address['street'];
                    $this->billing_address['city']          = $address['city'];
                    $this->billing_address['email']         = $address['email'];
                    $this->billing_address['telephone']     = $address['telephone'];
                    $this->billing_address['country_id']    = $address['country_id'];
                    $this->billing_address['firstname']     = $address['firstname'][0];
                    $this->billing_address['lastname']      = $address['lastname'];
                    $this->billing_address['prefix']        = $address['prefix'];
                    $this->billing_address['middlename']    = $address['middlename'];
                    $this->billing_address['suffix']        = $address['suffix'];
                    $this->billing_address['company']       = $address['company'];
                    break;

                case 'shipping' :
                    $this->shipping_address['region']        = $address['region'];
                    $this->shipping_address['postcode']      = $address['postcode'];
                    $this->shipping_address['street']        = $address['street'];
                    $this->shipping_address['city']          = $address['city'];
                    $this->shipping_address['email']         = $address['email'];
                    $this->shipping_address['telephone']     = $address['telephone'];
                    $this->shipping_address['country_id']    = $address['country_id'];
                    $this->shipping_address['firstname']     = $address['firstname'][0];
                    $this->shipping_address['lastname']      = $address['lastname'];
                    $this->shipping_address['prefix']        = $address['prefix'];
                    $this->shipping_address['middlename']    = $address['middlename'];
                    $this->shipping_address['suffix']        = $address['suffix'];
                    $this->shipping_address['company']       = $address['company'];
                    break;

            }
        }

        $line_number = 0;
        foreach ($order['order_items'] as $item) {
            $this->items = [
                'line_number'               => $line_number,
                'item_id'                   => $item['item_id'],
                'parent_item_id'            => $item['parent_item_id'],
                'sku'                       => $item['sku'],
                'name'                      => $item['name'],
                'qty_canceled'              => $item['qty_canceled'],
                'qty_invoiced'              => $item['qty_invoiced'],
                'qty_ordered'               => $item['qty_ordered'],
                'qty_refunded'              => $item['qty_refunded'],
                'qty_shipped'               => $item['qty_shipped'],
                'price'                     => $item['price'],
                'base_price'                => $item['base_price'],
                'original_price'            => $item['original_price'],
                'base_original_price'       => $item['base_original_price'],
                'tax_percent'               => $item['tax_percent'],
                'tax_amount'                => $item['tax_amount'],
                'base_tax_amount'           => $item['base_tax_amount'],
                'discount_amount'           => $item['discount_amount'],
                'base_discount_amount'      => $item['base_discount_amount'],
                'row_total'                 => $item['row_total'],
                'base_row_total'            => $item['base_row_total'],
                'price_incl_tax'            => $item['price_incl_tax'],
                'base_price_incl_tax'       => $item['base_price_incl_tax'],
                'row_total_incl_tax'        => $item['row_total_incl_tax'],
                'base_row_total_incl_tax'   => $item['base_row_total_incl_tax'],
            ];
            $line_number++;
        }

        $line_number = 0;
        foreach ($order['order_comments'] as $comment) {
            $this->items = [
                'line_number'           => $line_number,
                'is_customer_notified'  => $comment['is_customer_notified'],
                'is_visible_on_front'   => $comment['is_visible_on_front'],
                'comment'               => $comment['comment'],
                'status'                => $comment['status'],
                'created_at'            => $comment['created_at'],
            ];
            $line_number++;
        }

    }




}
