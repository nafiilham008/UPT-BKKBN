<footer class="margin-body">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3 col-sm-3 d-flex align-items-center justify-content-end mb-4 ">
                <img class="img-fluid-footer" src="{{ asset('img/logo/logo_upt_putih.png') }}" alt="Logo">
            </div>
            <div class="col-lg-3 col-sm-3">
                <h3>KONTAK</h3>
                <p class="text-footer-tablet">Telepon: (0281) 6445887</p>
                <p class="text-footer-tablet">Email: <a href="mailto:diklat.banyumas@bkkbn.go.id">diklat.banyumas@bkkbn.go.id</a></p>
            </div>
            <div class="col-lg-3 col-sm-3">
                <h3>ALAMAT</h3>
                <p class="text-footer-tablet">Jalan Raya Kejawar Km.1, </p>
                <p class="text-footer-tablet">Kec. Banyumas, Kab. Banyumas,</p>
                <P class="text-footer-tablet">Jawa Tengah 53192</p>
            </div>
            <div class="col-lg-3 col-sm-3">
                @php
                    use App\Models\visitor;
                    use Carbon\Carbon;

                    $todayVisitor = visitor::where('date', Carbon::now()->toDateString())->sum('day_count');
                    $thisWeekVisitor = visitor::where(
                        'date',
                        '>=',
                        Carbon::now()
                            ->startOfWeek()
                            ->toDateString(),
                    )->sum('week_count');
                    $thisMonthVisitor = visitor::where(
                        'date',
                        '>=',
                        Carbon::now()
                            ->startOfMonth()
                            ->toDateString(),
                    )->sum('month_count');
                    $thisYearVisitor = visitor::where(
                        'date',
                        '>=',
                        Carbon::now()
                            ->startOfYear()
                            ->toDateString(),
                    )->sum('year_count');
                @endphp
                <h3>PENGUNJUNG</h3>
                <p class="text-footer-tablet">Hari Ini: <span
                        class="badge rounded-pill text-bg-info count-footer">{{ $todayVisitor }}</span></p>
                <p class="text-footer-tablet">Bulan Ini: <span
                        class="badge rounded-pill text-bg-info count-footer">{{ $thisWeekVisitor }}</span></p>
                <p class="text-footer-tablet">Tahun Ini: <span
                        class="badge rounded-pill text-bg-info count-footer">{{ $thisMonthVisitor }}</span></p>
                <p class="text-footer-tablet">Total Pengunjung: <span
                        class="badge rounded-pill text-bg-info count-footer">{{ $thisYearVisitor }}</span></p>
            </div>
        </div>
    </div>
</footer>
