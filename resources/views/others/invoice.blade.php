<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Invoice #{{ $donation->unique_number }}</title>
</head>
<body class="bg-light">
    <div class="container h-100 w-100">
        <div class="bg-white rounded shadow-lg my-5 col-md-6 mx-auto p-5">
            <div class="w-25 mb-3">
                <img src="{{ asset('assets/img/brand/ydsf_color.png') }}" alt="" class="w-100">
            </div>
            <h5 class="mb-3">Halo, {{ $donation->user->name }}.</h5>
            <p>Terima kasih atas donasi yang Anda berikan pada program <strong>{{ $donation->program->title }}</strong>, berikut detail dari donasi yang sudah Anda berikan.</p>
            <table class="table table-striped table-bordered">
                <thead class=" thead-dark">
                    <tr>
                        <th colspan="2" class="text-center">Rincian Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-weight-bold">Program</td>
                        <td>{{ $donation->program->title }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Jumlah Donasi</td>
                        <td>@currency($donation->amount)</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Atas Nama</td>
                        <td>{{ $donation->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tanggal</td>
                        <td>{{ $donation->donation_date }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Status</td>
                        <td>
                            <span class="badge badge-success text-uppercase">{{ $donation->status }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>Donasi yang bapak/ibu berikan sangat bermanfaat bagi berjalannya program kami tersebut, dan semoga Allah segera membalas kebaikan yang bapak/ibu lakukan.</p>
            <p>Terima Kasih,<br><strong>Yayasan Dana Sosial Al-Falah</strong></p>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
