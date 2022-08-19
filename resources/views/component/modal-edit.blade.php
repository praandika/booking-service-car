@push('after-css')
<style>
    .btn-close {
        background-color: transparent;
        border: none;
        color: #cc1616;
    }

    .btn-close:hover {
        background-color: #cc1616;
        color: #ffffff;
    }

    .btn-close:focus {
        outline: none;
    }

</style>
@endpush
<!-- Modal -->
<div class="modal fade" id="modalEdit{{ $o->id }}" tabindex="-1" aria-labelledby="modalEditLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="typcn typcn-times"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.employee-update',$o->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $o->name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">No. Whatsapp/HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ $o->phone }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Posisi</label>
                            <select name="position" class="form-control" required>
                                <option value="{{ $o->position }}">
                                    {{ $o->position == 'SRO' ? 'Service Reminder Officer' : ($o->position == 'SM' ? 'Service Manager' : 'Teknisi')}}
                                </option>
                                <option disabled>------------------</option>
                                <option value="Teknisi">Teknisi</option>
                                <option value="SRO">Service Reminder Officer</option>
                                <option value="SM">Service Manager</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="typcn typcn-tick"></i> Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
