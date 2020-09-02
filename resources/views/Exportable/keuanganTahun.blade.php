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
                    <th style="width: 20%;">Bulan</th>
                    <th style="width: 20%;">Pemasukan</th>
                    <th style="width: 20%;">Pengeluaran</th>


                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                $index = 0;
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
                $total = 0;
                @endphp
                @foreach($data['hasil'] as $k => $d)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$data['bulan'][$k]}} {{$data['tahun']}} </td>
                    <td>Rp. {{number_format($d[0], 0, '.', '.')}}</td>
                    <td>Rp. {{number_format($d[1], 0, '.', '.')}}</td>
                    @php
                    $totalPemasukan += $d[0];
                    $totalPengeluaran +=$d[1];
                    @endphp
                </tr>

                @endforeach

                {{-- @if(count($data['pemasukan']) > count($data['pengeluaran']))
                @foreach($data['pemasukan'] as $d)
                <tr>
                    <td>{{ $i++ }}</td>
                <td>{{$data['bulan'][$d->bulan]}} {{$data['tahun']}} </td>
                <td>Rp. {{number_format($d->pemasukan, 0, '.', '.')}}</td>
                @if(empty($data['pengeluaran'][$index]->pengeluaran))
                <td>Rp. 0</td>
                @else
                <td>Rp. {{number_format($data['pengeluaran'][$index]->pengeluaran, 0, '.', '.')}}</td>
                @endif
                @php
                $totalPemasukan += $d->pemasukan;
                if(!empty($data['pengeluaran'][$index]->pengeluaran)){
                $totalPengeluaran += $data['pengeluaran'][$index++]->pengeluaran;
                }
                @endphp
                </tr>

                @endforeach
                @else
                @foreach($data['pengeluaran'] as $d)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$data['bulan'][$d->bulan]}} {{$data['tahun']}} </td>
                    @if(empty($data['pemasukan'][$index]->pemasukan))
                    <td>Rp. 0</td>
                    @else
                    <td>Rp. {{number_format($data['pemasukan'][$index]->pemasukan, 0, '.', '.')}}</td>
                    @endif
                    <td>Rp. {{number_format($d->pengeluaran, 0, '.', '.')}}</td>
                    @php
                    $totalPengeluaran += $d->pengeluaran;
                    if(!empty($data['pemasukan'][$index]->pemasukan)){
                    $totalPemasukan += $data['pemasukan'][$index++]->pemasukan;
                    }
                    @endphp
                </tr>

                @endforeach
                @endif --}}

                <tr>
                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                    <td colspan="1"><strong>Rp. {{number_format($totalPemasukan, 0, '.', '.')}}</strong></td>
                    <td colspan="1"><strong>Rp. {{number_format($totalPengeluaran, 0, '.', '.')}}</strong></td>
                </tr>

            </tbody>
        </table>
        {{-- </div> --}}
    </div>
</body>

</html>
