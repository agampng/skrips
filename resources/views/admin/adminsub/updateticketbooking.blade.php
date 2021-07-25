@extends('navigation.adminNavigation')

@section('content')

<div class="body" style="background-color:#77acf1;min-height:600px">
    <div class="container py-4">
        <form action="/guest/send-email" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perbarui Pemesanan Tiket</h5>
              </div>

              <div class="modal-body container">

                <div class="mb-2 ml-auto">
                    <label class="mb-2" for="email">Email</label>
                    <input type="email" class="form-control" placeholder="email perwakilan" name="email" id="email">
                </div>

                <div class="mb-2 ml-auto">
                    <label class="mb-2" for="nama">Nama</label>
                    <input type="text" class="form-control" placeholder="nama perwakilan" name="nama" id="nama">
                </div>

                @if(auth()->user()->roles == "SUPERADMIN")
                <div class="mt-2 ml-auto">
                    <div class="mb-2"><label for="museum">Pilih Museum</label></div>
                    <div class="mb-2">
                        <select class="form-select custom-select w-100 h-200" id="museum" name="museum" required="">
                            <option value="select">pilih museum...</option>
                            @foreach($museum as $data)
                                <option value="{{$data->id}}">{{$data->id}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                @else
                <input type="hidden" name="museum" value="{{auth()->user()->museum_id}}">
                @endif

                <div class="row">
                    <div class="mt-2 ml-auto col-10">
                        <div class="mb-2"><label for="tanggal">Pilih Tanggal Kunjungan</label></div>
                        <div class="mb-2">
                            <input type="date" class="form-control" name="visit_date" id="visit_date">
                        </div>
                    </div>

                    <div class="mt-2 ml-auto col">
                        <div class="mb-2"><label class="d-flex justify-content-center" for="jumlah">Jumlah Kuota</label></div>
                        <div class="mb-2"><label class="pt-2 d-flex justify-content-center kuota" for="angka">1</label></div>
                    </div>
                </div>

                <div class="mb-2"><label for="schedule">Pilih Jadwal</label></div>
                <div class="mb-2">
                    <select class="form-select custom-select d-block w-100" id="schedule" name="schedule" >
                        <option value="select">Tidak ada jadwal</option>
                    </select>
                </div>

                <div class="row">
                    <div class="mt-2 ml-auto col-6">
                        <div class="mb-2"><label for="tiket">Tiket yang Tersedia</label></div>
                    </div>
                    <div class="mt-2 ml-auto col-3">
                         <div class="mb-2"><label for="jumlah-tiket">Jumlah Tiket</label></div>
                    </div>
                </div>
                <div class="row input-belanjaan">
                    <div class="mt-2 ml-auto col-6">
                        <div class="mb-2 input-group">
                            <span class="input-group-text">Rp.</span>
                            <select class="ticket form-select custom-select d-block w-100%" id="ticket" name="ticket">
                            <option value="select">Tidak ada Tiket Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2 ml-auto col-3">
                        <div class="mb-2">
                            <input class="form-control width-20 quantity-input" type="number" value="1">
                        </div>
                    </div>
                    <div class="mt-2 ml-auto col-3">
                        <div class="mb-2">
                            <button type="button" class="form-control tambah">Tambah</button>
                        </div>
                    </div>
                    <div class="errors w-100" style="display:none;color:red;">Tiket ini sudah ada di daftar!</div>
                    <div class="q-errors w-100" style="display:none;color:red;">Jumlah tiket tidak memenuhi syarat!</div>
                </div>

                <div class="row">
                    <div class="mt-2 ml-auto col-6">
                        <div class="mb-2"><label for="tiket">Daftar Tiket</label></div>
                    </div>
                    <div class="mt-2 ml-auto col-3">
                         <div class="mb-2"><label for="jumlah-tiket">Jumlah</label></div>
                    </div>
                </div>
                <div class="daftar-belanjaan ">
                    <div class="row barang-belanjaan">
                        <div class="mt-2 ml-auto col-6 notice">
                            <div class="mb-2"><label for="tiket">Tiket ada barang di daftar</label></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mt-2 ml-auto col-6">
                        <div class="mb-2">
                            <label for="Total">Total :</label>
                            <label class="total-harga" for="harga">Rp.0</label>
                            <input id="input-total-harga" type="hidden" name="totalHarga" value="0" />
                        </div>
                    </div>
                    <div class="mt-2 ml-auto col-3">
                        <div class="mb-2 ">
                            <label class="total-kuota" for="kuota">0</label>
                            <input id="input-total-kuota" type="hidden" name="totalKuota" value="0" />
                            <label for="orang"> orang</label>
                        </div>
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-dismiss="modal">Pesan</button>
              </div>


            </div>
            </form>
    </div>
</div>

@endsection
