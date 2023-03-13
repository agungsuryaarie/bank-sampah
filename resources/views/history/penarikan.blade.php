@extends('layouts.app')

@section('content')
    <div class="content-header"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row-flex">
                <div class="col-lg-10 col-md-12">
                    <div class="invoice p-3 mb-3">
                        <div class="card-header ">
                            <h3 class="card-header-title text-center">{{ $menu }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive table-striped">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="3%">No</th>
                                            <th width="15%">Tanggal Penarikan</th>
                                            <th width="20%">Jumlah penarikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>23 Maret 2023 </td>
                                            <td>Rp 16.000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>23 Maret 2023 </td>
                                            <td>Rp 20.000</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2"></th>
                                            <th class="text-primary">Saldo Akhir : Rp 26.000</th>
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

@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
