<?php

namespace App\Http\Controllers;

use App\Mail\pesanEmail;
use App\Models\detailTiketPesanan;
use App\Models\TiketPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    //
    public $bookingTicket;
    public $bookingDetail;

    public function __construct()
    {
        $this->bookingTicket = new TiketPesanan;
        $this->bookingDetail = new detailTiketPesanan;
    }

    public function index(Request $request)
    {

        $sixdigit=$this->getName(6);
        if ($request->has('item')) {
            $items = $request->item;
            $date = $request->visit_date;
            $nama = $request->nama;
            $museum = $request->museum;
            $code = $sixdigit;
            $quota = $request->totalKuota;
            $price = $request->totalHarga;
            $email = $request->email;


            $ticketId =$this->bookingTicket->insertGetId([

            'tanggal_tiket_pesanan' => $date,
            "nama_perwakilan" => $nama,
            "email_perwakilan" => $email,
            'museum' => $museum,
            "kode" => $code,
            "total_harga" => $price,
            "kuota" => $quota,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),


            ]);

            foreach($items as $item)
            {
                $this->bookingDetail->create([
                    'pesanan_id' => $ticketId,
                    'detail' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    "created_at" =>  date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);
            }



            Mail::to($email)->send(new pesanEmail($items,$code,$nama,$price));

            return redirect()->back()->with('message','Pemesanan tiket telah berhasil!');


        }
        else
        {

            $request->validate(
                [
                    'daftarBarang' =>['required'],
                ],
                [
                    'daftarBarang.required' => 'harus mengisi daftar barang!'
                ]
            );
        }



    }

    function getName($digit)
        {
            $total_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $digit; $i++)
            {
                $index = rand(0, strlen($total_characters) - 1);
                $randomString .= $total_characters[$index];
            }
            return $randomString;
        }


}
