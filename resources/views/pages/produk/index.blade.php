@extends('layouts.mainadmin')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Produk</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="m-0">Daftar Produk</h5>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">Tambah Produk</a>
                    </div>
                    <table id="produkTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Sisa PCS</th>
                                <th>Sisa DOS</th>
                                <th>PCS per DOS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produk as $index => $item)
                                <tr>
                                    <td class="no-urut">{{ $index + 1 }}</td>
                                    <td>{{ $item->kode_produk }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->sisa_pcs }}</td>
                                    <td>{{ $item->sisa_dos }}</td>
                                    <td>{{ $item->pcs_per_dos }}</td>
                                    <td>
                                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#produkTable').DataTable({
                "order": [[1, 'asc']],  // Default sort by the second column (Kode Produk)
                "columnDefs": [
                    { "orderable": true, "targets": [0, 1, 2, 3, 4, 5] }  // Enable sorting on all columns
                ]
            });

            // Recalculate row numbers when the table is sorted or paginated
            table.on('order.dt search.dt', function() {
                table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
@endsection
