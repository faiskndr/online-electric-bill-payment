<h3><center>Penggunaan</center></h3>
<table border="1" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th>No</th>
      <th>Username</th>
      <th>Id Penggunaan</th>
      <th>Bulan</th>
      <th>Tahun</th>
      <th>Meter Awal</th>
      <th>Meter Akhir</th>
      <th>Jumlah Meter</th>
      <th>Tanggal</th>
    </tr>
    </thead>
      <tbody>
        @foreach ($result as $key => $item) 
        <tr>
        <td>{{$key + 1}}</td>
          {{-- @if ($item->pelanggan == NULL)
            <td>{{ $item->id_pelanggan}}</td>
          @else --}}
          <td>{{$item->username}}</td>
          {{-- @endif --}}
          <td>{{$item->id_penggunaan}}</td>
          <td>{{$item->bulan}}</td>
          <td>{{$item->tahun}}</td>
          <td>{{$item->meter_awal}}</td>
          <td>{{$item->meter_akhir}}</td>    
          <td>{{$item->meter_awal - $item->meter_akhir}}</td>    
          <td>{{$item->date}}</td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        @for ($i = 0; $i < 6; $i++)
        <td></td>              
        @endfor
        <td>total penggunaan</td>
        <td>{{$result->sum('meter_awal') - $result->sum('meter_akhir')}}</td>
        <td></td>
      </tr>
</table>
