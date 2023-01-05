<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md tw-shadow-gray-200">
        <h4 class="tw-text-lg">Master Data - Rak</h4>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card tw-shadow-md tw-shadow-gray-300 tw-rounded-lg tw-hidden lg:tw-block">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="kode_rak">Kode Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="kode_rak" id="kode_rak" wire:model='kode_rak'>
                                @error('kode_rak') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_rak">Nama Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="nama_rak" id="nama_rak" wire:model='nama_rak'>
                                @error('nama_rak') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" wire:click.prevent="store()" wire:loading.attr="disabled" class="btn btn-outline-success form-control tw-py-1">Save Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
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
                                <input wire:model.debounce.500ms="searchTerm" type="search" class="form-control tw-rounded-lg ml-auto"
                                    placeholder="Search here..">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="tw-table-fixed tw-w-full tw-text-black tw-text-md mt-3 tw-border-collapse tw-border">
                                <thead>
                                    <tr class="tw-border-b tw-text-xs text-center text-uppercase">
                                        <th class="p-3" width="20%">KODE RAK</th>
                                        <th class="p-3" width="10%">KETERANGAN</th>
                                        <th class="p-3 text-center" width="13%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                        <tr class="tw-bg-white tw-border tw-text-uppercase tw-border-gray-200 hover:tw-bg-gray-50">
                                            <td class="p-3">{{ $row->kode_rak }}</td>
                                            <td class="p-3">{{ $row->nama_rak }}</td>
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
                                        <td class="p-3" colspan="3">
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
        <button
            class="tw-fixed tw-right-[30px] tw-bottom-[50px] tw-w-14 tw-h-14 tw-shadow-2xl tw-rounded-full tw-bg-blue-700 tw-z-40 text-white hover:tw-bg-blue-900 hover:tw-border-slate-600 tw-block lg:tw-hidden"
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
                                <label for="kode_rak">Kode Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="kode_rak" id="kode_rak" wire:model='kode_rak'>
                                @error('kode_rak') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_rak">Nama Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="nama_rak" id="nama_rak" wire:model='nama_rak'>
                                @error('nama_rak') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <label for="kode_rak">Kode Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="kode_rak" id="kode_rak" wire:model='kode_rak'>
                                @error('kode_rak') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_rak">Nama Rak</label>
                                <input type="text" class="form-control tw-rounded-lg" name="nama_rak" id="nama_rak" wire:model='nama_rak'>
                                @error('nama_rak') <span class="text-danger">{{ $message }}</span> @enderror
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