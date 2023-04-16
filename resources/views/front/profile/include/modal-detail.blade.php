<div class="modal fade" id="detail-employee{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Employee Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="rounded-4 employee-photo" src="" alt="">
                    </div>
                    <div class="col-md-8">
                        <h3 class="employee-name"></h3>
                        <table class="table">
                            <tr>
                                <td>NIP</td>
                                <td class="employee-nip"></td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td class="employee-position"></td>
                            </tr>
                            {{-- <tr>
                                <td>Address</td>
                                <td class="employee-address"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="employee-email"></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td class="employee-phone"></td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
