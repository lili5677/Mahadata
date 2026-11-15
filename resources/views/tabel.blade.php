<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>NIM</th><th>Nama</th><th>Alamat</th><th>Tgl Lahir</th><th>Gender</th><th>Usia</th>
      @if ($aksi) <th>Aksi</th> @endif
    </tr>
  </thead>
  <tbody>
  @forelse ($mahasiswa as $m)
    <tr>
      <td>{{ $m->nim }}</td>
      <td>{{ $m->nama }}</td>
      <td>{{ $m->alamat }}</td>
      <td>{{ $m->tanggal_lahir->format('d-m-Y') }}</td>
      <td>{{ $m->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
      <td>{{ $m->usia }}</td>
      @if ($aksi)
        <td>
          <a href="{{ route('admin.edit', $m) }}" class="btn btn-warning btn-sm">Edit</a>
          <form method="post" action="{{ route('admin.destroy', $m) }}" class="d-inline"
                onsubmit="return confirm('Yakin hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Hapus</button>
          </form>
        </td>
      @endif
    </tr>
  @empty
    <tr><td colspan="7" class="text-center">Data tidak ada</td></tr>
  @endforelse
  </tbody>
</table>