<?php

namespace App\Traits;

trait HasSaleProcess
{
    public function itemProductPrice()
    {
        $color_price = empty($this->color_id) ? 0 : $this->color->price_increase;
        $warranty_price = empty($this->warranty_id) ? 0 : $this->warranty->price_increase;
        return $this->product->price + $color_price + $warranty_price;
    }

    public function itemFinalProductPrice()
    {
        $productPrice = $this->itemProductPrice();
        return $productPrice * $this->number;
    }

    public function itemProductDiscount()
    {
        $totlaPrice = $this->itemProductPrice();
        $discount = !empty($this->product->amazingSale()->latest()->first()) ? $this->product->amazingSale()->latest()->first()->percentage : 0 ;
        return ($totlaPrice * $discount) / 100;
    }

    public function itemFinalProductDiscount()
    {
        $totlaPrice = $this->itemFinalProductPrice();
        $discount = !empty($this->product->amazingSale()->latest()->first()) ? $this->product->amazingSale()->latest()->first()->percentage : 0 ;
        return ($totlaPrice * $discount) / 100;
    }

    public function itemFinalPrice()
    {
        $totalPrice = $this->itemProductPrice() - $this->itemProductDiscount();
        return $this->number * $totalPrice;
    }
}
