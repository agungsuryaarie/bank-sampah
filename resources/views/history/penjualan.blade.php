@extends('layouts.app')


@section('content')
    <div class="content-header"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row-flex">
                <div class="col-lg-10 col-md-12 ">
                    <div class="invoice p-3 mb-3">
                        <div class="card-header ">
                            <h3 class="card-header-title text-center">{{ $menu }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Sampah</th>
                                            <th>Berat</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>23 Maret 2023</td>
                                            <td>Plastik</td>
                                            <td>2 Kg</td>
                                            <td>Rp 12000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
