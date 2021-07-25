<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <title>Skripsi Project</title>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link active"><span class="sr-only fs-4">Museum - Museum di Jakarta</span></a>
                </li>
                  </div>
                </li>
              </ul>
            </div>
        </nav>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 py-4 px-2" style="background-color: #a7bbc7;">
            @foreach ($museum as $name)
            <div class="col">
                <div class="card shadow-sm" >
                    <div class="card-image "  style="background-color: #55595c" height="200px">
                    <img style="object-fit: cover" src=" {{ asset('museum/' .$name->gambar) }}"
                     class="card-img-top embed-responsive-item" width="auto" height="300px" alt="...">
                    </div>
                    <div class="card-body justify-content-center" style="flex-direction: column">

                      <p class="card-text">
                        <h5 class="text-center">{{$name->id}}</h5>
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <form class="px-2" action="/{{$name->id}}" method="GET">
                            @csrf
                              <button type="submit" class="btn btn-outline-secondary">Lihat</button>
                          </form>

                            @csrf
                            <button type="button" class="btn-outline-secondary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">pesan</button>
                            <!--modal 1-->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"     aria-hidden="true" >
                                <div class="modal-dialog modal-lg" >
                                    <!-- start form kirim email -->
                                    <!-- <form  action="/guest/send-email" method="POST"> form dibawah untuk checking-->
                                    <form action="/guest/send-email" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pesan Tiket</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>

                                      <div class="modal-body container">

                                        <div class="mb-2 ml-auto">
                                            <label class="mb-2" for="email">Email</label>
                                            <input type="email" class="form-control" placeholder="email perwakilan" name="email" id="email" required>

                                        </div>

                                        <div class="mb-2 ml-auto">
                                            <label class="mb-2" for="nama">Nama</label>
                                            <input type="text" class="form-control" placeholder="nama perwakilan" name="nama" id="nama" required>
                                        </div>

                                        <div class="mt-2 ml-auto">
                                            <div class="mb-2"><label for="museum">Pilih Museum</label></div>
                                            <div class="mb-2">
                                                <select class="form-select custom-select w-100 h-200" id="museum" name="museum" required="">
                                                    <option value="">pilih museum...</option>
                                                    @foreach($museum as $data)
                                                        <option value="{{$data->id}}">{{$data->id}}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                            <div class="errors w-100" style="display:none;color:red;" id="museum-alert">Pilih museum terlebih dahulu!</div>
                                        </div>

                                        <div class="row">
                                            <div class="mt-2 ml-auto col-10">
                                                <div class="mb-2"><label for="tanggal">Pilih Tanggal Kunjungan</label></div>
                                                <div class="mb-2">
                                                    <input type="date" class="form-control" name="visit_date" id="visit_date" required>
                                                </div>
                                                <div class="errors w-100" style="display:none;color:red;" id="date-alert">Pilih tanggal terlebih dahulu!</div>
                                                @error('visit_date')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                                            </div>

                                            <div class="mt-2 ml-auto col">
                                                <div class="mb-2"><label class="d-flex justify-content-center" for="jumlah">Jumlah Kuota</label></div>
                                                <div class="mb-2" >
                                                    <label class="pt-2 d-flex justify-content-center kuota" id="kuota" name="kuota" for="angka">0</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="mb-2"><label for="schedule">Pilih Jadwal</label></div>
                                        <div class="mb-2">
                                            <select class="form-select custom-select d-block w-100" id="schedule" name="schedule" required="">
                                                <option value="">Pilih tanggal terlebih dahulu</option>
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
                                            <div class="mt-2 ml-auto col-3" id="input-kuota">
                                                <div class="mb-2" id="jumlah-tiket">
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
                                            <div class="l-errors w-100" style="display:none;color:red;">Tidak bisa membeli tiket melebihi kuota!</div>
                                            <div class="i-errors w-100" style="display:none;color:red;">Itu bukan barang belanjaan!</div>
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
                                                    <input id="daftar-barang-check" type="hidden" name="daftarBarang" value=""/>
                                                    @error('daftarBarang')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
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
                                        <button type="submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Pesan</button>
                                      </div>


                                    </div>
                                    </form>
                                    <!-- end form kirim email -->
                                </div>
                            </div>
                            <!--end modal 1-->



                        </div>
                      </div>
                    </div>
                </div>
              </div>
            @endforeach
        </div>

<script>
    if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
    } else {
        ready()
    }

    //get schedule dropdown


    $('#visit_date').change(function()
    {
        visitChange();

    })//end of #visit_date.change function


    $('#museum').change(function()
    {
        visitChange();
    });//get schedule drop down

    //get ticket dropdown
    $('#schedule').change(function()
    {
        document.getElementsByClassName('total-harga')[0].innerHTML= "Rp. "+0;
        document.getElementsByClassName('total-kuota')[0].innerHTML= 0;
        var scheduleID = $(this).val();
        $(".daftar-belanjaan").empty();
        let cartRow = document.createElement('div')
        cartRow.classList.add('row');
        cartRow.classList.add('barang-belanjaan');
        let cartRowContents = `
        <div class="mt-2 ml-auto col-6 notice">
        <div class="mb-2"><label for="tiket">Tiket ada barang di daftar</label></div>
        <input id="daftar-barang-check" type="hidden" name="daftarBarang" value="" />
        @error('daftarBarangCheck')
        <div class="alert-danger">{{$message}}</div>
        @enderror
        </div>
        `
        cartRow.innerHTML = cartRowContents;
        $(".daftar-belanjaan").append(cartRow);

        $("#input-kuota").empty();
        let input = document.createElement('div');
        input.classList.add('mb-2');
        let inputContent=`<input class="form-control width-20 quantity-input" type="number" value="1">`;
        input.innerHTML = inputContent;
        $("#input-kuota").append(input);
        $(".quantity-input").on("change",quantityChanged);
        $("#ticket").empty();
        $("#ticket").append('<option value="">Tidak Ada Tiket Tersedia</option>');

        if(scheduleID)
        {
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
            });//end of ajax setup
            $.ajax({
                type:"GET",
                url:"/ajax-request-only/get-ticket-by-schedule?schedule_id="+scheduleID,
                success:function(data){
                    if(data != ""){
                        $("#ticket").empty();
                        $("#ticket").append('<option value="">Pilih Tiket...</option>');
                        $.each(data,function(key,value){
                            $("#ticket").append('<option value="'+value.id+'">'+value.harga+'/'+value.target+'</option>');
                        });
                        $("#jumlah-tiket").empty();
                        $("#jumlah-tiket").append('<input class="form-control width-20 quantity-input" type="number" value="0">');
                    }else
                    {
                        $("#ticket").empty();
                        $("#ticket").append('<option value="">Tidak Ada Tiket Tersedia</option>');
                        $("#jumlah-tiket").empty();
                        $("#jumlah-tiket").append('<input class="form-control width-20 quantity-input" type="number" value="0">');
                    }
                }
            });
        }
    });//get ticket drop down

    function visitChange()
    {
        $(".daftar-belanjaan").empty();
        let cartRow = document.createElement('div')
        cartRow.classList.add('row');
        cartRow.classList.add('barang-belanjaan');
        let cartRowContents = `
        <div class="mt-2 ml-auto col-6 notice">
            <div class="mb-2"><label for="tiket">Tiket ada barang di daftar</label></div>
            <input id="daftar-barang-check" type="hidden" name="daftarBarang" value="" />
            @error('daftarBarangCheck')
            <div class="alert-danger">{{$message}}</div>
            @enderror
        </div>
        `
        cartRow.innerHTML = cartRowContents;
        $(".daftar-belanjaan").append(cartRow);

        $("#input-kuota").empty();
        let input = document.createElement('div');
        input.classList.add('mb-2');
        let inputContent=`<input class="form-control width-20 quantity-input" type="number" value="1">`;
        input.innerHTML = inputContent;
        $("#input-kuota").append(input);
        $(".quantity-input").on("change",quantityChanged);
        $("#ticket").empty();
        $("#ticket").append('<option value="">Tidak Ada Tiket Tersedia</option>');

        document.getElementsByClassName('total-harga')[0].innerHTML= "Rp. "+0;
        document.getElementsByClassName('total-kuota')[0].innerHTML= 0;
        var museumID = $('#museum').val();
        var museumAlert = $('#museum-alert');
        var dateAlert = $('#date-alert');
        var ticketDate = $('#visit_date').val();
        if(museumID == '')
        {
            museumAlert.show();
        }
        else
        {

            if(ticketDate == '')
            {
                dateAlert.show();
            }
            else
            {
                museumAlert.hide();
                dateAlert.hide();
                $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                });//end of ajax setup

                $.ajax({
                    type:"GET",
                    url:"/ajax-request-only/get-schedule-by-museum",
                    data:{
                        museum_id: museumID,
                        visit_date: ticketDate,
                    },
                    success:function(response){

                        if(response.schedule != ""){
                            $("#schedule").empty();
                            $("#schedule").append('<option value="">Pilih Jadwal...</option>');
                            $.each(response.schedule,function(key,value){
                                $("#schedule").append('<option value="'+value.id+'"> '+value.hari_pertama+' - '+value.hari_terakhir+' / '   +value.jam_buka+' - '+value.jam_tutup+' </option>');
                            });

                        }else
                        {
                            $("#schedule").empty();
                            $("#schedule").append('<option value="">Tidak Ada Jadwal</option>');
                        }
                        $("#kuota").empty();
                        $("#kuota").append(response.quota);

                    }
                }); //end of ajax function
            }//end of 2nd if
        }//end of 1st if

    }//end visitChange

    function ready(){

        var removeCartItemButtons = document.getElementsByClassName("remove");
        for (var i = 0; i < removeCartItemButtons.length; i++){

            var button = removeCartItemButtons[i];
            button.addEventListener('click', removeCartItem)
        };

        var quantityInputs = document.getElementsByClassName('quantity-input')
        for (var i = 0; i < quantityInputs.length; i++) {
            var input = quantityInputs[i]
            input.addEventListener('change', quantityChanged)
        };

        var addCartItemButtons = document.getElementsByClassName('tambah')
        for (var i = 0; i < addCartItemButtons.length; i++){
            var button = addCartItemButtons[i];
            button.addEventListener('click', addCartItem)
        };


        var selectDropDown = document.getElementsByClassName('new-item')
        for (var i = 0; i < selectDropDown.length; i++){
            var item = selectDropDown[i];
            item.addEventListener('change', refreshData)
        };
    };

    function quantityChanged(){
        var input = event.target;
        var limit = document.getElementsByClassName('kuota')[0].innerHTML;
        if (isNaN(input.value) || input.value < 1) {
            input.value = 1
        }
        else if(input.value > +limit){
            input.value = +limit
        }
        updateCartTotal()
    }

    function removeCartItem(){
        var buttonClicked = event.target;
        var buttonParent = buttonClicked.parentElement.parentElement.parentElement;
        buttonClicked.parentElement.parentElement.parentElement.remove();
        buttonParent = document.getElementsByClassName('daftar-belanjaan')[0];
        if(buttonParent.children.length == 0)
        {
            let cartRow = document.createElement('div')
            cartRow.classList.add('row');
            cartRow.classList.add('barang-belanjaan');
            let cartRowContents = `
            <div class="mt-2 ml-auto col-6 notice">
                <div class="mb-2"><label for="tiket">Tiket ada barang di daftar</label></div>
                <input id="daftar-barang-check" type="hidden" name="daftarBarang" value="" />
                @error('daftarBarangCheck')
                <div class="alert-danger">{{$message}}</div>
                @enderror
            </div>
            `
            cartRow.innerHTML = cartRowContents;
            buttonParent.append(cartRow);
        }
        updateCartTotal();
    }

    function addCartItem()
    {
        let target = document.getElementsByClassName('input-belanjaan')[0];
        let alert = target.getElementsByClassName('q-errors')[0];
        let alert2 = target.getElementsByClassName('i-errors')[0];
        let check = document.getElementsByClassName('daftar-belanjaan')[0];
        let lastChild = check.querySelectorAll('.order').length

        if(check.querySelector('.order') != null)
        {
            order = +check.querySelectorAll('.order')[lastChild-1].innerHTML.replace('.','') + 1;
        }else
        {
            order = 1;
        }

        let buttonClicked = event.target;
        let shopItem = buttonClicked.parentElement.parentElement.parentElement;
        let itemList = shopItem.getElementsByClassName('ticket')[0];
        let barang=itemList.options[itemList.selectedIndex].text;
        let harga= barang.split("/")[0];
        let clacification = barang.split("/")[1];
        let jumlah = shopItem.getElementsByClassName('quantity-input')[0].value;

        alert2.style.display ="none";
        if(isNaN(harga))
        {
            alert2.style.display ="block";
            return
        }else
        {
            if( jumlah == 0)
            {

                alert.style.display ="block";
                return

            }
            else
            {
                alert.style.display ="none";
                if(target.querySelector('.notice') != null)
                {
                    let child = target.querySelector('.notice')
                    child.remove()
                }
                let itemQty = target.getElementsByClassName('quantity-input')[0].value;
                addItemToCart(barang,clacification,harga,itemQty,order);
            }

        }
    }

    function addItemToCart(name,clacification,price,qty,order){
        let cartItemDiv = document.createElement('div')
        cartItemDiv.classList.add('row')
        cartItemDiv.classList.add('barang-belanjaan')
        let lalert = document.getElementsByClassName('l-errors')[0];
        let cart = document.getElementsByClassName('daftar-belanjaan')[0]
        let dropDownItem = document.getElementsByClassName('input-belanjaan')[0]
        let alert = dropDownItem.getElementsByClassName('errors')[0];
        alert.style.display ="none";
        cartItemNames = document.getElementsByClassName('barang');


        for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerHTML == name) {
            alert.style.display ="block";
            return
            }
        }

        let cartItemContainer = document.getElementsByClassName('daftar-belanjaan')[0];
        let cartRows = cartItemContainer.getElementsByClassName('barang-belanjaan');
        let totalJumlah = 0;
        if(cartItemContainer.querySelector('.barang') != null)
        {
            for (var i = 0; i < cartRows.length; i++){
                let cartRow = cartRows[i];
                let itemElement = cartRow.getElementsByClassName('barang')[0].innerHTML;
                let quantityElement = cartRow.getElementsByClassName('jumlah')[0].innerHTML;
                let priceElement = itemElement.split("/")[0];
                let total = priceElement*quantityElement;
                totalJumlah = totalJumlah + +quantityElement;

            };


        }
        totalJumlah = totalJumlah + +qty;
        console.log(totalJumlah);
        let limitKuota = document.getElementsByClassName('kuota')[0].innerHTML;

        if(totalJumlah > +limitKuota)
        {

            lalert.style.display ="block";
            return;
        }
        else
        {
            lalert.style.display ="none";
            let cartItemDivContents = `
            <div class="mt-2 ml-auto col-6">
                <div class="mb-2">
                    <label class="order" for="order">${order}.</label>
                    <label class="barang" for="barang" id="barang${order}">${name}</label>
                    <input type="hidden" name="item[${order-1}][nama]" value="${name}" />
                    <input type="hidden" name="item[${order-1}][jumlah]" value="${qty}" />
                    <input type="hidden" name="item[${order-1}][klasifikasi]" value="${clacification}" />
                </div>
            </div>
            <div class="mt-2 ml-auto col-3">
                <div class="mb-2">
                <label class="jumlah" for="jumlah">${qty}</label>

                </div>
            </div>
            <div class="mt-2 ml-auto col-3">
                <div class="mb-2"><button type="button" class="form-control hapus">Hapus</button></div>
            </div>
            `
            cartItemDiv.innerHTML = cartItemDivContents
            cart.append(cartItemDiv);
        }




        if(cart.querySelector('.notice') != null)
        {
            let child = cart.querySelector('.notice').parentElement
            child.remove()
        }
        cart.getElementsByClassName('hapus')[0].addEventListener('click', removeCartItem)
        updateCartTotal();
    }

    function updateCartTotal(){

        let cartItemContainer = document.getElementsByClassName('daftar-belanjaan')[0];
        let cartRows = cartItemContainer.getElementsByClassName('barang-belanjaan');
        let totalHarga = 0;
        let totalJumlah = 0;
        if(cartItemContainer.querySelector('.barang') != null)
        {
            for (var i = 0; i < cartRows.length; i++){
                let cartRow = cartRows[i];
                let itemElement = cartRow.getElementsByClassName('barang')[0].innerHTML;
                let quantityElement = cartRow.getElementsByClassName('jumlah')[0].innerHTML;
                let priceElement = itemElement.split("/")[0];
                let total = priceElement*quantityElement;
                totalJumlah = totalJumlah + +quantityElement;
                totalHarga = totalHarga + total;
                totalHarga = Math.round(totalHarga * 100) / 100;
            };


        }

        document.getElementById("input-total-harga").value = totalHarga;
        document.getElementById("input-total-kuota").value = totalJumlah;
        totalHargaFixed = totalHarga.toLocaleString("id");
        totalHtext = document.getElementsByClassName('total-harga')[0].innerHTML= "Rp. "+totalHargaFixed;

        document.getElementsByClassName('total-kuota')[0].innerHTML= totalJumlah;
    }

</script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>


