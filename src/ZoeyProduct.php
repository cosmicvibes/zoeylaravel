<?php

// TODO: Add store support

namespace Cosmicvibes\Zoeylaravel;

class ZoeyProduct extends Zoey
{
    public $entity_id;
    public $type_id; // type
    public $sku;
    public $name;
    public $url_key;

    public $meta_title;
    public $meta_description;
    public $zoey_design_template;
    public $options_container;
    public $special_from_date;
    public $special_to_date;
    public $news_from_date;
    public $news_to_date;
    public $status;
    public $tax_class_id;
    public $visibility;
    public $condition; // item_condition
    public $apply_tier_price_to_variations;
    public $pix_widget_featured_product;
    public $size;

    public $price;
    public $special_price;
    public $cost;
    public $msrp;
    public $msrp_enabled;
    public $msrp_display_actual_price_type;
    public $weight;
    public $description;
    public $short_description;

    public $attribute_set_id;

    public $categories = [];
    public $images = [];

    /**
     * ZoeyOrder constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $config_extra_product_fields = config('zoey.product_extra_fields');
        foreach ($config_extra_product_fields as $key => $value) {
            $this->{"$value"} = null;
        }

    }

    public function load($sku)
    {

        $tmp_product = $this->client->get('/api/rest/products'
            .'?filter[0][attribute]=sku&filter[0][eq][0]='.$sku
        )->send()->json();

        if (count($tmp_product) === 0) {
            // TODO: Don't like this, throw exception instead
            return null;
        }

        $product = $tmp_product[key($tmp_product)];

        // Get the product data
        $this->entity_id = (array_key_exists('entity_id', $product) ? $product['entity_id'] : null);
        $this->attribute_set_id = (array_key_exists('attribute_set_id',
            $product) ? $product['attribute_set_id'] : null);
        $this->type_id = (array_key_exists('type_id', $product) ? $product['type_id'] : null);
        $this->sku = (array_key_exists('sku', $product) ? $product['sku'] : null);
        $this->name = (array_key_exists('name', $product) ? $product['name'] : null);
        $this->url_key = (array_key_exists('url_key', $product) ? $product['url_key'] : null);
        $this->msrp_enabled = (array_key_exists('msrp_enabled', $product) ? $product['msrp_enabled'] : null);
        $this->msrp_display_actual_price_type = (array_key_exists('msrp_display_actual_price_type',
            $product) ? $product['msrp_display_actual_price_type'] : null);
        $this->meta_title = (array_key_exists('meta_title', $product) ? $product['meta_title'] : null);
        $this->meta_description = (array_key_exists('meta_description',
            $product) ? $product['meta_description'] : null);
        $this->zoey_design_template = (array_key_exists('zoey_design_template',
            $product) ? $product['zoey_design_template'] : null);
        $this->options_container = (array_key_exists('options_container',
            $product) ? $product['options_container'] : null);
        $this->special_from_date = (array_key_exists('special_from_date',
            $product) ? $product['special_from_date'] : null);
        $this->special_to_date = (array_key_exists('special_to_date', $product) ? $product['special_to_date'] : null);
        $this->news_from_date = (array_key_exists('news_from_date', $product) ? $product['news_from_date'] : null);
        $this->news_to_date = (array_key_exists('news_to_date', $product) ? $product['news_to_date'] : null);
        $this->status = (array_key_exists('status', $product) ? $product['status'] : null);
        $this->visibility = (array_key_exists('visibility', $product) ? $product['visibility'] : null);
        $this->condition = (array_key_exists('condition', $product) ? $product['condition'] : null);
        $this->tax_class_id = (array_key_exists('tax_class_id', $product) ? $product['tax_class_id'] : null);
        $this->apply_tier_price_to_variations = (array_key_exists('apply_tier_price_to_variations',
            $product) ? $product['apply_tier_price_to_variations'] : null);
        $this->pix_widget_featured_product = (array_key_exists('pix_widget_featured_product',
            $product) ? $product['pix_widget_featured_product'] : null);
        $this->size = (array_key_exists('size', $product) ? $product['size'] : null);
        $this->special_price = (array_key_exists('special_price', $product) ? $product['special_price'] : null);
        $this->price = (array_key_exists('price', $product) ? $product['price'] : null);
        $this->cost = (array_key_exists('cost', $product) ? $product['cost'] : null);
        $this->msrp = (array_key_exists('msrp', $product) ? $product['msrp'] : null);
        $this->weight = (array_key_exists('weight', $product) ? $product['weight'] : null);
        $this->description = (array_key_exists('description', $product) ? $product['description'] : null);
        $this->short_description = (array_key_exists('short_description',
            $product) ? $product['short_description'] : null);

        // Add extra fields from config
        // TODO: Guard against this being missing
        $config_extra_product_fields = config('zoey.product_extra_fields');
        foreach ($config_extra_product_fields as $key => $value) {
            $this->{"$value"} = $product[$key];
        }

        // Get the product categories
        $limit = 9999;
        $categories = $this->client->get('/api/rest/products/'
            .$this->entity_id.
            '/categories/'
            .'?limit='.$limit)->send()->json();

        foreach ($categories as $category) {
            $category_data['category_id'] = $category['category_id'];
            $this->categories[] = $category_data;
        }

        // Get the product images
        $limit = 9999;
        $images = $this->client->get('/api/rest/products/'
            .$this->entity_id.
            '/images/'
            .'?limit='.$limit)->send()->json();

        foreach ($images as $image) {
            $image_data['id'] = $image['id'];
            $image_data['label'] = $image['label'];
            $image_data['position'] = $image['position'];
            $image_data['exclude'] = $image['exclude'];
            $image_data['url'] = $image['url'];

            $this->images[] = $image_data;
        }

    }
}
