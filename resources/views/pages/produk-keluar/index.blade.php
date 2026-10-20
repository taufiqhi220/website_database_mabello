@extends('layouts.mainadmin')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Produk Keluar</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="m-0">Daftar Produk Keluar</h5>
                        <a href="{{ route('produkkeluar.create') }}" class="btn btn-primary btn-sm">Tambah Produk Keluar</a>
                    </div>
                    <table id="produkKeluarTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Tanggal Keluar</th>
                                <th>Nomor Batch/Exp</th>
                                <th>Distribution Center</th>
                                <th>Jumlah (PCS)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkKeluar as $index => $item)
                                <tr>
                                    <td class="no-urut">{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->tanggal_keluar }}</td>
                                    <td>{{ $item->nomor_batch_exp }}</td>
                                    <td>{{ $item->distribution_center }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data produk keluar.</td>
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
            var table = $('#produkKeluarTable').DataTable({
                "order": [[1, 'asc']],  // Default sort by the second column (Nama Produk)
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
