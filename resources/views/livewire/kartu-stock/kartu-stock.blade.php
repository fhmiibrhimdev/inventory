<div>
    <div class="section-header tw-rounded-lg tw-text-black tw-shadow-md">
        <h4 class="tw-text-lg">Kartu Stock</h4>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card tw-rounded-md tw-shadow-md">
                    <div class="card-body">
                        <h4 class="tw-text-black tw-text-lg mb-3 text-center">F I L T E R</h4>
                        <div class="form-group mt-3">
                            <label for="filter_id_barang">Nama Item</label>
                            <div wire:ignore>
                                <select name="filter_id_barang" id="filter_id_barang" wire:model='filter_id_barang'
                                    class="form-control tw-rounded-lg">
                                    <option value="0">-- Pilih Barang --</option>
                                    @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filter_dari_tanggal">Dari Tanggal</label>
                            <input type="datetime-local" name="filter_dari_tanggal" id="filter_dari_tanggal"
                                wire:model='filter_dari_tanggal' class="form-control tw-rounded-lg">
                        </div>
                        <div class="form-group">
                            <label for="filter_sampai_tanggal">s/d Tanggal</label>
                            <input type="datetime-local" name="filter_sampai_tanggal" id="filter_sampai_tanggal"
                                wire:model='filter_sampai_tanggal' class="form-control tw-rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card tw-rounded-md tw-shadow-md">
                    <div class="card-body px-0">
                        <div class="row mb-3 px-4">
                            <div class="col-4 col-lg-2 tw-flex">
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
                            </div>
                            <div class="col-8 col-lg-4 ml-auto tw-flex">
                                <span class="mt-2 text-dark mr-1 tw-hidden lg:tw-block">Search:</span>
                                <input wire:model.debounce.500ms="searchTerm" type="search" class="form-control tw-rounded-lg ml-auto"
                                    placeholder="Search here..">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="tw-table-fixed tw-w-full tw-text-black tw-text-md mt-3 tw-border-collapse tw-border">
                                <thead>
                                    <tr class="tw-border-b tw-text-xs text-center text-uppercase">
                                        <th rowspan="2" class="p-3">Tanggal</th>
                                        <th rowspan="2" class="p-3">Keterangan</th>
                                        <th rowspan="2" class="p-3">STOCK AWAL</th>
                                        <th colspan="2" class="p-3">MUTASI</th>
                                        <th rowspan="2" class="p-3">STOCK AKHIR</th>
                                    </tr>
                                    <tr class="tw-border-b tw-text-xs text-center text-uppercase">
                                        <th class="p-3">IN</th>
                                        <th class="p-3">OUT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data == '')
                                    <tr id="table-row" class="text-center">
                                        <td class="p-3" colspan="6">
                                            No data available in table
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                    $amountIn = 0;
                                    $amountOut = 0;
                                    $amountBalance = 0;
                                    $amountBalanceLast = 0;
                                    @endphp
                                    @forelse ($data as $row)
                                    <tr
                                        class="tw-bg-white tw-border tw-uppercase tw-border-gray-200 hover:tw-bg-gray-50 text-center">
                                        <td class="p-3">{{ $row->tanggal }}</td>
                                        <td class="p-3">{{ $row->keterangan }}</td>
                                        <td class="p-3">
                                            @if ($row->status == 'Balance')
                                            @php
                                            $amountBalance += $row->qty;
                                            @endphp
                                            {{ $row->qty }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @if ($row->status == 'In')
                                            @php
                                            $amountIn += $row->qty;
                                            @endphp
                                            {{ $row->qty }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @if ($row->status == 'Out')
                                            @php
                                            $amountOut += $row->qty;
                                            @endphp
                                            {{ $row->qty }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @php
                                            $amountBalanceLast = last((array)$row->balancing);
                                            @endphp
                                            {{ $row->balancing }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td class="p-3" colspan="7">
                                            No data available in table
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <thead>
                                    <tr class="tw-text-center">
                                        <th class="p-3 tw-text-center" colspan="2">TOTAL</th>
                                        <th class="p-3">{{ $amountBalance }}</th>
                                        <th class="p-3">{{ $amountIn }}</th>
                                        <th class="p-3">{{ $amountOut }}</th>
                                        <th class="p-3">{{ $amountBalanceLast }}</th>
                                    </tr>
                                </thead>
                                @endif

                            </table>
                        </div>
                        <div class="table-responsive p-3">
                            @if ($data == '')

                            @else
                            {{ $data->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
            $('#filter_id_barang').select2();
            $('#filter_id_barang').on('change', function (e) {
                var data = $('#filter_id_barang').select2("val");
                @this.set('filter_id_barang', data);
            });
        });
</script>
@endpush