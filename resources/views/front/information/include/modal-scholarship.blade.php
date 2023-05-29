<div class="modal fade" id="detail-scholarship{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Beasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img class="rounded-4 scholarship-photo" src="" alt="">
                    </div>
                    <div class="col-md-12 mt-4">
                        <h3 class="scholarship-title text-center"></h3>
                        <h6 class="mt-3">Deskripsi</h6>
                        <p class="scholarship-description"></p>
                        <table class="table">
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ $item->link }}" class="btn btn-detail-scholarship" target="_blank">Selengkapnya</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
