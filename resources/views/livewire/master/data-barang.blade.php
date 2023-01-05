<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md tw-shadow-gray-200">
        <h4 class="tw-text-lg">Master Data - Barang</h4>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-inventory tw-text-5xl text-info"></i>
                            <div class="ml-3">
                                <span class="tw-font-bold tw-text-black">{{ $tersedia }} Barang</span>
                                <p>Tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-truck-loading tw-text-5xl text-danger"></i>
                            <div class="ml-3">
                                <span class="tw-font-bold tw-text-black">{{ $stok_habis }} Barang</span>
                                <p>Stok Habis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-box-full tw-text-5xl text-success"></i>
                            <div class="ml-3">
                                <span class="tw-font-bold tw-text-black">{{ $stok_tersedia }} Barang</span>
                                <p>Stok Tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-hand-holding-box tw-text-5xl text-warning"></i>
                            <div class="ml-3">
                                <span class="tw-font-bold tw-text-black">{{ $stok_sedikit }} Barang</span>
                                <p>Stok Sedikit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg">
                    <div class="card-body px-0">
                        <div class="row mb-3 px-4">
                            <div class="col-4 col-lg-2 tw-flex">
                                <span class="mt-2 text-dark mr-2 tw-hidden lg:tw-block">Show</span>
                                <select class="form-control tw-rounded-lg" wire:model='lengthData'>
                                    <option value="0" selected>All</option>
                                    <option value="1" selected>1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                            <div class="col-8 col-lg-4 ml-auto tw-flex">
                                <span class="mt-2 text-dark mr-1 tw-hidden lg:tw-block">Search:</span>
                                <input type="search" class="form-control tw-rounded-lg ml-auto" placeholder="Search here.." wire:model.debounce.500ms='searchTerm'>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="tw-table-fixed tw-w-full tw-text-black tw-text-md mt-3 tw-border-collapse tw-border">
                                <thead>
                                    <tr class="tw-border-b tw-text-xs text-center text-uppercase">
                                        <th class="p-3">Gambar</th>
                                        <th class="p-3">KD BRG</th>
                                        <th class="p-3">NM BRG</th>
                                        <th class="p-3">STOCK</th>
                                        <th class="p-3">JNS</th>
                                        <th class="p-3">MRK</th>
                                        <th class="p-3">KTGRI</th>
                                        <th class="p-3">RAK</th>
                                        <th class="p-3">KET</th>
                                        <th class="p-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                    <tr class="tw-bg-white tw-border tw-border-gray-200 hover:tw-bg-gray-50 tw-text-center">
                                        <td class="p-3"><img class="tw-rounded-lg" src="{{ asset('storage/'.$row->gambar) }}" width="100%" alt=""></td>
                                        <td class="p-3">{{ $row->kode_item }}</td>
                                        <td class="p-3">{{ $row->nama_item }}</td>
                                        <td class="p-3">{{ $row->stock }}</td>
                                        <td class="p-3">{{ $row->nama_jenis }}</td>
                                        <td class="p-3">{{ $row->nama_merek }}</td>
                                        <td class="p-3">{{ $row->kode_kategori }}</td>
                                        <td class="p-3">{{ $row->nama_rak }}</td>
                                        <td class="p-3">{{ $row->keterangan }}</td>
                                        <td class="p-3 text-center">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#ubahDataModal" wire:click="edit({{ $row->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" wire:click.prevent="deleteConfirm({{ $row->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td class="p-3" colspan="9">
                                            No data available in table
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-3">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="tw-fixed tw-right-[30px] tw-bottom-[50px] tw-w-14 tw-h-14 tw-shadow-2xl tw-rounded-full tw-bg-blue-700 tw-z-40 text-white hover:tw-bg-blue-900 hover:tw-border-slate-600" data-toggle="modal" data-target="#tambahDataModal">
            <i class="far fa-plus"></i>
        </button>
    </div>

    {{-- Insert Data Modal --}}
    <div class="modal fade" wire:ignore.self id="tambahDataModal" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                @if ($gambar == '')
                                    <img src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" class="tw-rounded-lg tw-object-cover tw-h-full tw-w-full mb-3">
                                @else
                                    <img src="{{ $gambar->temporaryUrl() }}" class="tw-rounded-lg tw-object-cover tw-h-full tw-w-full mb-3">
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file form-group">
                                    <input type="file" wire:model='gambar' class="custom-file-input tw-rounded-lg" id="gambar">
                                    <label class="custom-file-label" for="gambar">Upload foto barang</label>
                                    @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="kode_item">Kode Barang</label>
                                            <input type="text" class="form-control tw-rounded-lg tw-uppercase" name="kode_item" id="kode_item" wire:model='kode_item'>
                                            @error('kode_item') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_item">Nama Barang</label>
                                            <input type="text" class="form-control tw-rounded-lg tw-uppercase" name="nama_item" id="nama_item" wire:model='nama_item'>
                                            @error('nama_item') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="id_jenis">Nama Jenis</label>
                                            <div wire:ignore>
                                                <select class="form-control tw-rounded-lg" name="id_jenis" id="id_jenis" wire:model='id_jenis'>
                                                    @foreach ($jenis as $jeniss)
                                                    <option value="{{ $jeniss->id }}">{{ $jeniss->nama_jenis }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_jenis') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="id_merek">Nama Merek</label>
                                            <div wire:ignore>
                                                <select class="form-control tw-rounded-lg" name="id_merek" id="id_merek" wire:model='id_merek'>
                                                    @foreach ($mereks as $merek)
                                                    <option value="{{ $merek->id }}">{{ $merek->nama_merek }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_merek') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="id_satuan">Nama Satuan</label>
                                            <div wire:ignore>
                                                <select class="form-control tw-rounded-lg" name="id_satuan" id="id_satuan" wire:model='id_satuan'>
                                                    @foreach ($satuans as $satuan)
                                                    <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_satuan') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="id_kategori">Nama Kategori</label>
                                            <div wire:ignore>
                                                <select class="form-control tw-rounded-lg" name="id_kategori" id="id_kategori" wire:model='id_kategori'>
                                                    @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_kategori') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="id_rak">Lokasi Rak</label>
                                            <div wire:ignore>
                                                <select class="form-control tw-rounded-lg" name="id_rak" id="id_rak" wire:model='id_rak'>
                                                    @foreach ($raks as $rak)
                                                    <option value="{{ $rak->id }}">{{ $rak->nama_rak }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_rak') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control tw-rounded-lg" name="keterangan" id="keterangan" wire:model='keterangan' style="height: 100px"></textarea>
                                    @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="store()" wire:loading.attr="disabled" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Insert Data Modal --}}

    {{-- Update Data Modal --}}
    <div class="modal fade" wire:ignore.self id="ubahDataModal" aria-labelledby="ubahDataModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataModalLabel">Edit Data</h5>
                    <button type="button" wire:click.prevent='cancel()' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" wire:model='dataId'>
                        @if ($gambar)
                            Photo Preview:
                            <img src="{{ $gambar->temporaryUrl() }}">
                        @endif
                        <div class="custom-file form-group">
                            <input type="file" wire:model='gambar' class="custom-file-input tw-rounded-lg" id="gambar">
                            <label class="custom-file-label" for="gambar">Upload foto barang</label>
                            @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kode_item">Kode Barang</label>
                                    <input type="text" class="form-control tw-rounded-lg tw-uppercase" name="kode_item" id="kode_item" wire:model='kode_item'>
                                    @error('kode_item') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_item">Nama Barang</label>
                                    <input type="text" class="form-control tw-rounded-lg tw-uppercase" name="nama_item" id="nama_item" wire:model='nama_item'>
                                    @error('nama_item') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="edit_id_jenis">Nama Jenis</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="edit_id_jenis" id="edit_id_jenis" wire:model='id_jenis'>
                                            @foreach ($jenis as $jeniss)
                                            <option value="{{ $jeniss->id }}">{{ $jeniss->nama_jenis }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_jenis') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="edit_id_merek">Nama Merek</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="edit_id_merek" id="edit_id_merek" wire:model='id_merek'>
                                            @foreach ($mereks as $merek)
                                            <option value="{{ $merek->id }}">{{ $merek->nama_merek }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_merek') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="edit_id_satuan">Nama Satuan</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="edit_id_satuan" id="edit_id_satuan" wire:model='id_satuan'>
                                            @foreach ($satuans as $satuan)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_satuan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_id_kategori">Nama Kategori</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="edit_id_kategori" id="edit_id_kategori" wire:model='id_kategori'>
                                            @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_kategori') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_id_rak">Lokasi Rak</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="edit_id_rak" id="edit_id_rak" wire:model='id_rak'>
                                            @foreach ($raks as $rak)
                                            <option value="{{ $rak->id }}">{{ $rak->nama_rak }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_rak') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control tw-rounded-lg" name="keterangan" id="keterangan" wire:model='keterangan' style="height: 100px"></textarea>
                            @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent='cancel()' class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click.prevent="update()" wire:loading.attr="disabled" type="button" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update Data Modal --}}


</div>

@push('scripts')

<script>
    $(document).ready(function() {
        $('#id_jenis').select2();
        $('#id_merek').select2();
        $('#id_satuan').select2();
        $('#id_kategori').select2();
        $('#id_rak').select2();

        $('#id_jenis').on('change', function(e) {
            var data = $('#id_jenis').select2("val");
            @this.set('id_jenis', data);
        });
        $('#id_merek').on('change', function(e) {
            var data = $('#id_merek').select2("val");
            @this.set('id_merek', data);
        });
        $('#id_satuan').on('change', function(e) {
            var data = $('#id_satuan').select2("val");
            @this.set('id_satuan', data);
        });
        $('#id_kategori').on('change', function(e) {
            var data = $('#id_kategori').select2("val");
            @this.set('id_kategori', data);
        });
        $('#id_rak').on('change', function(e) {
            var data = $('#id_rak').select2("val");
            @this.set('id_rak', data);
        });

        $('#edit_id_jenis').select2();
        $('#edit_id_merek').select2();
        $('#edit_id_satuan').select2();
        $('#edit_id_kategori').select2();
        $('#edit_id_rak').select2();

        $('#edit_id_jenis').on('change', function(e) {
            var data = $('#edit_id_jenis').select2("val");
            @this.set('id_jenis', data);
        });
        $('#edit_id_merek').on('change', function(e) {
            var data = $('#edit_id_merek').select2("val");
            @this.set('id_merek', data);
        });
        $('#edit_id_satuan').on('change', function(e) {
            var data = $('#edit_id_satuan').select2("val");
            @this.set('id_satuan', data);
        });
        $('#edit_id_kategori').on('change', function(e) {
            var data = $('#edit_id_kategori').select2("val");
            @this.set('id_kategori', data);
        });
        $('#edit_id_rak').on('change', function(e) {
            var data = $('#edit_id_rak').select2("val");
            @this.set('id_rak', data);
        });
    });
</script>

@endpush