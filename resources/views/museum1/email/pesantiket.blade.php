

<h3 style="color:black">Halo, {{ $name }} !</h3>

<p>
    <a href="http://museumjakarta.online/">http://museumjakarta.online/</a>
    <div style="color: black">Berikut ini kode untuk pesanan tiket kalian :</div>
    <h3>
        {{$code}}
    </h3>

    <table style="border-collapse: collapse;width: 400px;">
        <tr>
            <th style="padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;">Tiket</th>
            <th style="padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;">Jumlah</th>
       </tr>
       @foreach ( $item as $item )
       <tr>
        <td style="border: 1px solid #ddd;padding: 8px;color:black;">Rp.{{$item['nama']}} </td>
        <td style="border: 1px solid #ddd;padding: 8px;color:black;text-align: center">{{$item['jumlah']}}</td>
        </tr>
     @endforeach

    </table>

    <br>
    <h3>Total harga:Rp.{{$total}}</h3>
</p>






