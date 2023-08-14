<h3><center>Penggunaan</center></h3>
<table border="1" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th>No</th>
      <th>Id Tagihan</th>
      <th>Id Pelanggan</th>
      <th>Nama Pelanggan</th>
      <th>Jumlah Meter</th>
      <th>Tagihan</th>
      <th>Status</th>
    </tr>
    </thead>
      <tbody>
        @foreach ($tagihan as $key => $item) 
        <tr>
        <td>{{$key + 1}}</td>
          <td>{{$item->id_tagihan}}</td>
          <td>{{$item->id_pelanggan}}</td> 
          <td>{{$item->nama_pelanggan}}</td> 
          <td>{{$item->jumlah_meter}}</td>    
          <td>{{$item->total}}</td>    
          <td>{{$item->status}}</td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        @for ($i = 0; $i < 4; $i++)
        <td></td>              
        @endfor
        <td>total tagihan</td>
        <td>{{ $tagihan->sum('total') }}</td>
        <td></td>
      </tr>
</table>
