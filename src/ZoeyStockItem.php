<?php

namespace Cosmicvibes\Zoeylaravel;

class ZoeyStockItem extends Zoey
{

    public $item_id;
    public $product_id;
    public $stock_id;
    public $qty;
    public $min_qty;
    public $use_config_min_qty;
    public $is_qty_decimal;
    public $backorders;
    public $use_config_backorders;
    public $min_sale_qty;
    public $use_config_min_sale_qty;
    public $max_sale_qty;
    public $use_config_max_sale_qty;
    public $is_in_stock;
    public $low_stock_date;
    public $notify_stock_qty;
    public $use_config_notify_stock_qty;
    public $manage_stock;
    public $use_config_manage_stock;
    public $stock_status_changed_auto;
    public $use_config_qty_increments;
    public $qty_increments;
    public $use_config_enable_qty_inc;
    public $enable_qty_increments;
    public $is_decimal_divided;

    /**
     * ZoeyOrder constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function load($product_id)
    {

        $tmp_stockitem = $this->client->get('/api/rest/stockitems'
            .'?filter[0][attribute]=product_id&filter[0][eq][0]='.$product_id
        )->send()->json();

        $stockitem = $tmp_stockitem[key($tmp_stockitem)];

        $this->item_id = $stockitem['item_id'];
        $this->product_id = $stockitem['product_id'];
        $this->stock_id = $stockitem['stock_id'];
        $this->qty = $stockitem['qty'];
        $this->min_qty = $stockitem['min_qty'];
        $this->use_config_min_qty = $stockitem['use_config_min_qty'];
        $this->is_qty_decimal = $stockitem['is_qty_decimal'];
        $this->backorders = $stockitem['backorders'];
        $this->use_config_backorders = $stockitem['use_config_backorders'];
        $this->min_sale_qty = $stockitem['min_sale_qty'];
        $this->use_config_min_sale_qty = $stockitem['use_config_min_sale_qty'];
        $this->max_sale_qty = $stockitem['max_sale_qty'];
        $this->use_config_max_sale_qty = $stockitem['use_config_max_sale_qty'];
        $this->is_in_stock = $stockitem['is_in_stock'];
        $this->low_stock_date = $stockitem['low_stock_date'];
        $this->notify_stock_qty = $stockitem['notify_stock_qty'];
        $this->use_config_notify_stock_qty = $stockitem['use_config_notify_stock_qty'];
        $this->manage_stock = $stockitem['manage_stock'];
        $this->use_config_manage_stock = $stockitem['use_config_manage_stock'];
        $this->stock_status_changed_auto = $stockitem['stock_status_changed_auto'];
        $this->use_config_qty_increments = $stockitem['use_config_qty_increments'];
        $this->qty_increments = $stockitem['qty_increments'];
        $this->use_config_enable_qty_inc = $stockitem['use_config_enable_qty_inc'];
        $this->enable_qty_increments = $stockitem['enable_qty_increments'];
        $this->is_decimal_divided = $stockitem['is_decimal_divided'];

    }


}
