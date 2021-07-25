<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaMuseum extends Model
{
    protected $table = 'agenda_museum';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['nama_agenda','museum_id','isi_agenda','deskripsi_agenda','tanggal_mulai_agenda','tanggal_berakhir_agenda','created_at','updated_at'];

    public function getMuseumEventById($museumId)
    {
        //ini cuma formula belum di get dalam bentuk koleksi untuk pilih event sorting by museum id
        $museumEvent = AgendaMuseum::where('museum_id',$museumId);
        return $museumEvent;
    }

    public function getSelectedEvent($museumId,$eventId)
    {
        $selectedEvent = AgendaMuseum::where('museum_id',$museumId)->where('id',$eventId);
        return $selectedEvent;
    }

    public function getEventName($event)
    {
        //get event name dari single collection yang sudah di sort pakai id
        $eventName = $event->implode('nama_agenda');
        return $eventName;
    }

    public function getEventDetail($event)
    {
        $eventDetail = $event->implode('isi_agenda');
        return $eventDetail;
    }

    public function getEventStartDate($event)
    {
        $startDate = $event->implode('tanggal_mulai_agenda');
        $editedStartDate = \Carbon\Carbon::parse($startDate)->format('d/m/Y');
        return $editedStartDate;
    }
    public function getEventEndDate($event)
    {
        $endDate = $event->implode('tanggal_berakhir_agenda');
        $editedEndDate = \Carbon\Carbon::parse($endDate)->format('d/m/Y');
        return $editedEndDate;
    }

    public function getEventImage($event)
    {
        $image = $event->implode('nama_gambar');
        return $image;
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


        $sliced_event = $collection->slice($offset,$limit);
        $paginated_event = collect([
            'sliced_collection' => $sliced_event,
            'prev_button' => $prev_button,
            'next_button' => $next_button,
            'page' => $page
            ]
        );

        return $paginated_event;
    }

}
