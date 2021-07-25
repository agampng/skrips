@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color: #77acf1;">


<div class="row py-4 g-0 mx-4" style="height:800px">
    <div class="col mx-2" style="border:2px solid #3edbf0">
        <h4 class="text-center py-2" style="border-bottom:2px solid #3edbf0">Menu Buat</h4>
        <div class="row g-0 py-2">
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newmuseum">
                <b>museum baru</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newevent">
                <b>agenda baru</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newcollection"> <b>koleksi baru</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newschedule"> <b>jadwal baru museum</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newticket"> <b>tiket baru museum</b></a></div>
        </div>

    </div>
    <div class="col mx-2" style="border:2px solid #3edbf0">
        <h4 class="col text-center py-2" style="border-bottom:2px solid #3edbf0">Menu Perbarui</h4>
        <div class="row g-0 py-2">
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updatemuseum"> <b>memperbarui museum</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updateevent"> <b>memperbarui agenda</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updatecollection"> <b>memperbarui koleksi</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updateschedule"> <b>memperbarui jadwal</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updateticket"> <b>
                memperbarui tiket</b></a></div>
        </div>
    </div>
    <div class="col mx-2" style="border:2px solid #3edbf0">
        <h4 class="text-center py-2" style="border-bottom:2px solid #3edbf0">Menu Hapus</h4>
        <div class="row g-0 py-2"  >
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/deletecollection"> <b>hapus koleksi</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/deleteschedule"><b>hapus jadwal</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/deleteticket"><b>hapus tiket</b></a></div>
        </div>
    </div>
    <div class="col mx-2" style="border:2px solid #3edbf0">
        <h4 class="text-center py-2" style="border-bottom:2px solid #3edbf0">Menu Admin</h4>
        <div class="row g-0 py-2"  >
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/newbooking"> <b>Buat Tiket</b></a></div>
            <div class="w-100"></div>
            <div class="col-1"></div>
            <div class="col pt-1 pb-2"><a class="navbar-nav nav-link active" style="color:#f0ebcc;" href="/admin/updatebooking"><b>Update Tiket</b></a></div>
        </div>
    </div>
</div>

</div>

@endsection
