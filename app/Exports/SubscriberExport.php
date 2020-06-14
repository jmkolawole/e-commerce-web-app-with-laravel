<?php
namespace App\Exports;

use App\Subscriber;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriberExport implements FromArray,WithHeadings
{
    public function array(): array
    {
        $subscribers = Subscriber::select('id','email','created_at')->get();
        $subscribers = json_decode(json_encode($subscribers),true);

        return $subscribers;
    }

    public function headings(): array
    {
        return ['ID','Email','Date Created'];
    }


}