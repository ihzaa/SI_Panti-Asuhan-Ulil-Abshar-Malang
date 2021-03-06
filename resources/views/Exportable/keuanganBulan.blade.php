<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pengeluaran</title>
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
                    <th style="width: 20%;">Tanggal</th>
                    <th style="width: 20%;">Keterangan</th>
                    <th style="width: 20%;">Pemasukan</th>
                    <th style="width: 20%;">Pengeluaran</th>


                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
                $total = 0;
                @endphp
                @foreach($data['keuangan'] as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{Carbon\Carbon::parse($p->tanggal)->format('d-m-Y')}}</td>
                    @if($p->pemasukan != '-')
                    <td>Dari {{$p->keterangan}}</td>
                    <td>Rp. {{number_format($p->pemasukan, 0, '.', '.')}}</td>
                    @else
                    <td>{{$p->keterangan}}</td>
                    <td>-</td>
                    @endif
                    @if($p->pengeluaran != '-')
                    <td>Rp. {{number_format($p->pengeluaran, 0, '.', '.')}}</td>
                    @else
                    <td>- </td>
                    @endif
                    @php
                    if($p->pemasukan != '-'){
                      $totalPemasukan += $p->pemasukan;
                    }
                    if($p->pengeluaran != '-'){
                      $totalPengeluaran += $p->pengeluaran;
                    }
                    @endphp
                </tr>

                @endforeach
                <tr>
                    <td colspan="3" class="text-center"><strong>Total</strong></td>
                    <td colspan="1"><strong>Rp. {{number_format($totalPemasukan, 0, '.', '.')}}</strong></td>
                    <td colspan="1"><strong>Rp. {{number_format($totalPengeluaran, 0, '.', '.')}}</strong></td>
                </tr>

            </tbody>
        </table>
        {{-- </div> --}}
    </div>
</body>

</html>