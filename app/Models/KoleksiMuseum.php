<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiMuseum extends Model
{
    protected $table = 'koleksi_museum';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['nama_gambar','gambar','museum_id','created_at','updated_at'];

    public function getMuseumCollectionById($museumId)
    {
        //ini cuma formula belum di get dalam bentuk koleksi
        $selectiveCollection = KoleksiMuseum::where('museum_id',$museumId);
        return $selectiveCollection;
    }

    public function lastSixCollection($selectedCollection)
    {
        //ini cuma formula belum di get dalam bentuk koleksi
        $lastSix = $selectedCollection->latest()->take(4);
        return $lastSix;
    }

    public function paginate($selected_page , $collection , $perPage)
    {
        //membatasi jumlah koleksi yang diperlihatkan setiap halaman
        $limit = $perPage;
        //ceil digunaka untuk round up total_page jadi bisa tau jumlah total halaman
        $total_page = ceil($collection->count()/$limit);

        if($selected_page > 0)
        {
            if($selected_page > $total_page)
            {
                $page = $total_page;
            }else
            {
                $page = $selected_page;
            }

        }
        else
        {
            $page = 1;
        }

        if($page == 1)
        {
            $prev_button = 'hide';
            $next_button = 'show';
        }
        elseif($page >= $total_page)
        {
            $prev_button = 'show';
            $next_button = 'hide';
        }
        else
        {
            $prev_button = 'show';
            $next_button = 'show';
        }


        //offset untuk mencari id mulai collection di potong
        $offset = ($page*$limit) - $limit ;


        $sliced_collection = $collection->slice($offset,$limit);
        $paginated_collection = collect([
            'sliced_collection' => $sliced_collection,
            'prev_button' => $prev_button,
            'next_button' => $next_button,
            'page' => $page
            ]
        );

        return $paginated_collection;
    }
}
