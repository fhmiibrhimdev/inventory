<div>
    <div class="text-center mt-5">
        <h2 class="text-uppercase font-bold">PT Solution Intek Indonesia</h2>
        <h4 class="text-uppercase">Laporan Saldo Awal Item</h4>
        <h5 class="text-uppercase">Periode: 30 November 2022</h5>
    </div>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center text-uppercase">
                    <th>No</th>
                    <th width="25%">Tanggal</th>
                    <th>Nama Barang</th>
                    <th width="8%">QTY</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $no++; }}</td>
                    <td class="text-center">{{ $row->tanggal }}</td>
                    <td>{{ $row->nama_item }}</td>
                    <td class="text-center">{{ $row->qty }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
