<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('id','product_name','product_code','product_color','price','status')->orderBy('id','desc')->get();
    }

    public function headings(): array
    {
        return ['ID','Product Name','Product Code','Product Color','Product Price','Status'];
    }
}
