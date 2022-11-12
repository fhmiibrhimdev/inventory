<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md tw-shadow-gray-200">
        <h4 class="tw-text-lg">Dashboard</h4>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-200 tw-rounded-lg">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="dari_tanggal">Dari Tanggal</label>
                                <input type="text" class="form-control tw-rounded-lg" name="dari_tanggal" id="dari_tanggal" wire:model='dari_tanggal'>
                                @error('dari_tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="sampai_tanggal">Sampai Tanggal</label>
                                <input type="text" class="form-control tw-rounded-lg" name="sampai_tanggal" id="sampai_tanggal" wire:model='sampai_tanggal'>
                                @error('sampai_tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card tw-shadow-md tw-shadow-gray-200 card-primary">
                    <div class="card-body px-0">
							<div class="row mb-3 px-4">
								<div class="col-4 col-lg-2 tw-flex">
									<span class="mt-2 text-dark mr-1 tw-hidden lg:tw-block">Show</span>
									<select class="form-control" wire:model='lengthData'>
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
									<span class="mt-2 text-dark ml-1 tw-hidden lg:tw-block">Data</span>
								</div>
								<div class="col-8 col-lg-4 ml-auto tw-flex">
									<span class="mt-2 text-dark mr-1 tw-hidden lg:tw-block">Search:</span>
									<input wire:model="searchTerm" type="search" class="form-control tw-rounded-lg ml-auto"
										placeholder="Search here.." wire:model='searchTerm'>
								</div>
							</div>

							<div class="table-responsive">
								<table class="tw-table-fixed tw-w-full tw-text-black tw-text-md mt-3 tw-border-collapse tw-border">
									<thead>
										<tr class="tw-border-b tw-text-xs text-center text-uppercase">
											<th class="p-3" width="20%">Nama Project</th>
											<th class="p-3" width="10%">Tgl Mulai</th>
											<th class="p-3 text-center" width="13%"></th>
										</tr>
									</thead>
									<tbody>
										<tr class="tw-bg-white tw-border tw-text-uppercase tw-border-gray-200 hover:tw-bg-gray-50">
											<td class="p-3">PROJECT TOKEN</td>
											<td class="p-3">02 September 2022</td>
											<td class="p-3 text-center">
												<button class="btn btn-primary" data-toggle="modal" data-target="#ubahDataModal" wire:click="edit()">
													<i class="fas fa-edit"></i>
												</button>
												<button class="btn btn-danger" wire:click.prevent="deleteConfirm()">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="text-center">
											<td class="p-3" colspan="3">
												No data available in table
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="table-responsive p-3">
								{{-- {{ $data->links() }} --}}
							</div>
                        
                    </div>
                </div>
            </div>
        </div>
			<button
				class="tw-fixed tw-right-[30px] tw-bottom-[50px] tw-w-14 tw-h-14 tw-shadow-2xl tw-rounded-full tw-bg-slate-600 tw-z-40 text-white hover:tw-bg-slate-900 hover:tw-border-slate-600"
				data-toggle="modal" data-target="#tambahDataModal">
				<i class="far fa-plus"></i>
			</button>
    </div>

    {{-- Insert Data Modal --}}
		<div class="modal fade" wire:ignore.self id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form>
						<div class="modal-body">
							<div class="form-group">
								<label for="nama_barang">Nama Barang</label>
								<input type="text" wire:model="nama_barang" id="nama_barang" class="form-control">
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="kode_barang">Kode Barang</label>
										<input type="text" wire:model="kode_barang" id="kode_barang" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="satuan">Satuan</label>
										<input type="text" wire:model="satuan" id="satuan" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="harga_barang">Harga Barang</label>
								<input type="number" wire:model="harga_barang" id="harga_barang" class="form-control">
							</div>
							<div class="form-group">
								<label for="jenis_barang">Jenis Barang</label>
								<select wire:model="jenis_barang" id="jenis_barang" class="form-control">
									<option value="" disabled selected>-- Jenis Barang --</option>
									<option value="Fabrikasi">Fabrikasi</option>
									<option value="Cleaning Supply">Cleaning Supply</option>
								</select>
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
		<div class="modal fade" wire:ignore.self id="ubahDataModal" tabindex="-1" aria-labelledby="ubahDataModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
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
							<div class="form-group">
								<label for="nama_barang">Nama Barang</label>
								<input type="text" wire:model="nama_barang" id="nama_barang" class="form-control">
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="kode_barang">Item Code</label>
										<input type="text" wire:model="kode_barang" id="kode_barang" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="satuan">Item Unit</label>
										<input type="text" wire:model="satuan" id="satuan" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="harga_barang">Harga Barang</label>
								<input type="number" wire:model="harga_barang" id="harga_barang" class="form-control">
							</div>
							<div class="form-group">
								<label for="jenis_barang">Jenis Barang</label>
								<select wire:model="jenis_barang" id="jenis_barang" class="form-control">
									<option value="" disabled selected>-- Jenis Barang --</option>
									<option value="Fabrikasi">Fabrikasi</option>
									<option value="Cleaning Supply">Cleaning Supply</option>
								</select>
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