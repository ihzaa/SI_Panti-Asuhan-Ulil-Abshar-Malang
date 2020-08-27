<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donasi</title>
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap.min.css')}}">
</head>

<body>
    <div class="container-fluid">
        {{-- <div class="row mb-2">
            <div class="col-4"> --}}
        {{-- <img src="{{url('/assets/aspiration/images/logo.jpg')}}" alt=""> --}}
        {{-- </div> --}}
        {{-- <div class="col-8 py-5 my-auto text-center"> --}}
        <img src="{{url('/assets/aspiration/images/logo.jpg')}}" alt="" style="position: relative;" height="200">
        <div style="position: absolute;top: 70px;left: 300px;">
            <h4>Panti Asuhan Ulil Abshar Putra Muhammadiyah Malang</h4>
            <h6>Laporan {{$data['keterangan']}}</h6>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div class="row"> --}}
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Nama Rekening</th>
                    <th style="width: 20%;">Nama Alias</th>
                    <th style="width: 20%;">Donasi</th>
                    <th style="width: 15%;">Bank</th>
                    <th style="width: 20%;">Tanggal Donasi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                $total = 0;
                @endphp
                @foreach($data['donasi'] as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$p->nama_donatur}}</td>
                    <td>{{$p->nama_alias}}</td>
                    <td>Rp. {{number_format($p->total_donasi, 0, '.', '.')}}</td>
                    <td>{{$p->nama_bank}}</td>
                    <td>{{Carbon\Carbon::parse($p->created_at)->format('d-m-Y')}}</td>
                    @php
                    $total += $p->total_donasi;
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td colspan="3"><strong>Rp. {{number_format($total, 0, '.', '.')}}</strong></td>
                </tr>
            </tbody>
        </table>
        {{-- </div> --}}
    </div>
</body>

</html>
