@push('after-css')
    <style>
        .btn-close{
            background-color: transparent;
            border: none;
            color: #cc1616;
        }

        .btn-close:hover{
            background-color: #cc1616;
            color: #ffffff;
        }

        .btn-close:focus{
            outline: none;
        }
    </style>
@endpush
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="typcn typcn-times"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{ Route::is('admin.work-order-form') ? route('admin.employee-store-at-wo-page') : route('admin.employee-store') }}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama karyawan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">No. Whatsapp/HP</label>
                            <input type="text" name="phone" class="form-control" placeholder="Masukkan kontak karyawan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Posisi</label>
                            <select name="position" class="form-control" required>
                                <option value="">Pilih Posisi</option>
                                <option value="Teknisi">Teknisi</option>
                                <option value="SRO">Service Reminder Officer</option>
                                <option value="SM">Service Manager</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="typcn typcn-tick"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
