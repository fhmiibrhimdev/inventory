<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md tw-shadow-gray-200">
        <h4 class="tw-text-lg">Laporan Saldo Awal Item</h4>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="activities">
                    @foreach ($data as $row)
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="activity-detail">
                            <div class="mb-2">
                                <span class="text-job text-primary">{{ $row->tanggal }}</span>
                                <span class="bullet"></span>
                                <a class="text-job" href="#">{{ $row->name }}</a>
                            </div>
                            <p>Menambahkan saldo awal barang: <b class="tw-text-gray-900">{{ $row->nama_item }}</b> sebanyak <b class="tw-text-gray-900">{{ $row->qty }}</b> pcs</p>
                            <p>Keterangan: <br /><b class="tw-text-gray-900">{{ $row->keterangan }}</b></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
