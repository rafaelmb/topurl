<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $products = [
        ['Milk', '1.25', 2],
        ['Eggs', '4.99', 1],
        ['Granulated sugar', '1.25', 1],
        ['Broccoli', '2.34', 3],
        ['Chocolate bar', '1.25', 5],
        ['Organic All-purpose flour', '4.99', 2]
    ];

    //
    public function showProducts()
    {
        /*
         * Given a list of products such as 'name', 'unit price', 'quantity',
         * - write a script to display the products sorted by prices, the most expensive first
         * - if 2 products have the same price, sort by quantities, the highest first
         * - bonus: display in your sorted list of products the total price per product (quantity * unit price)
         */

        usort($this->products, [$this, 'sortProduct']);

        foreach ($this->products as $key => $product) {
            $this->products[$key][3] = $product[2] * (float)$product[1];
        }

        return view('welcome', ['products' => $this->products]);
    }

    public static function sortProduct($a, $b)
    {
       $priceA = (float)$a[1];
       $priceB = (float)$b[1];

       if ($priceA === $priceB) {
           return $a[2] < $b[2];
       }

        return (float)$a[1] < (float)$b[1];
    }
}
