<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md tw-shadow-gray-200">
        <h4 class="tw-text-lg">Laporan Saldo Awal Barang</h4>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_user">Nama User</label>
                            <select wire:model="id_user" id="id_user" class="form-control tw-rounded-lg">
                                <option value="0">-- Select Option --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select wire:model="id_barang" id="id_barang" class="form-control tw-rounded-lg">
                                <option value="0">-- Select Option --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dari_tanggal">Dari Tanggal</label>
                            <input type="datetime-local" wire:model='dari_tanggal' id="dari_tanggal" class="form-control tw-rounded-lg">
                        </div>
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="datetime-local" wire:model='sampai_tanggal' id="sampai_tanggal" class="form-control tw-rounded-lg">
                        </div>
                        <div class="tw-grid tw-grid-cols-2 tw-gap tw-gap-3">
                            <div>
                                <a href="{{ route('laporan-excel.saldo-awal', ["id_barang"=> $this->id_barang,
                                    "dari_tanggal" => $this->dari_tanggal, "sampai_tanggal" =>
                                    $this->sampai_tanggal]) }}" class="btn btn-outline-success tw-w-full"
                                    target="_BLANK">
                                    <i class="far fa-file-excel"></i> EXCEL
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('laporan-pdf.saldo-awal', ["id_barang"=> $this->id_barang,
                                    "dari_tanggal" => $this->dari_tanggal, "sampai_tanggal" =>
                                    $this->sampai_tanggal]) }}" class="btn btn-outline-danger tw-w-full"
                                    target="_BLANK">
                                    <i class="far fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="activities">
                    @foreach ($data as $row)
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            <i class="far fa-history tw-text-lg"></i>
                        </div>
                        <div class="activity-detail">
                            <div class="mb-2">
                                <span class="text-job text-primary">{{ $row->tanggal }}</span>
                                <span class="bullet"></span>
                                <a class="text-job" href="#">{{ $row->name }}</a>
                            </div>
                            <p>Menambahkan saldo awal barang: <b class="tw-text-gray-900">{{ $row->nama_item }}</b> sebanyak <b class="tw-text-gray-900">{{ $row->qty }}</b> pcs</p><br/>
                            <p>Keterangan: <br /><b class="tw-text-gray-900">{{ $row->keterangan }}</b></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
