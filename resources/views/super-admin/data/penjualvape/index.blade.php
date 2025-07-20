<thead>
<tr>
    <th>Nama Toko</th>
    <th>Pemilik</th>
    <th>Lokasi</th>
    <th>No HP</th>
    <th>Liquid Dicurigai</th>
    <th>Distributor</th>
    <th>Created By</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($vapeList as $vape)
<tr>
    <td>{{ $vape->nama_toko }}</td>
    <td>{{ $vape->pemilik }}</td>
    <td>{{ $vape->lokasi }}</td>
    <td>{{ $vape->no_hp }}</td>
    <td>{{ $vape->liquid_dicurigai }}</td>
    <td>{{ $vape->distributor }}</td>
    <td>{{ $vape->user->name ?? '-' }}</td>
    <td><!-- aksi --></td>
</tr>
@endforeach
</tbody> 