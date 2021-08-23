<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print Card</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" type="text/css">


</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
        }

        table { border: 1px solid #ccc; border-collapse: collapse; margin: 0; padding: 0; width: 100%; table-layout: fixed;}
      table caption { font-size: 1.5em; margin: .5em 0 .75em;}
      table tr { border: 1px solid #ddd; padding: .35em;}
      table th,
      table td { padding: .625em; text-align: center;}
      table th { font-size: .85em; letter-spacing: .1em; text-transform: uppercase;}
      @media screen and (max-width: 600px) {
        table { border: 0; }
        table caption { font-size: 1.3em; }
        table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px;}
        table tr { border-bottom: 3px solid #ddd; display: block; margin-bottom: .625em; }
        table td { border-bottom: 1px solid #ddd; display: block; font-size: .8em; text-align: right;}
        table td::before { content: attr(data-label); float: left; font-weight: bold; text-transform: uppercase; }
        table td:last-child { border-bottom: 0; }
      }

    </style>

    <br>

    <div>
        <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px; float: left;" />

        <div>
            <h4 style=" text-align: center;margin-bottom:0;margin-top:0">Laporan Penjualan</h4>
            <h5 style=" text-align: center;margin-bottom:0;margin-top:0">Periode</h5>
            <h5 style=" text-align: center;margin-bottom:0;margin-top:0">20-08-2021 - 23-08-2021</h5>
        </div>

        <hr>

        <table>
            <thead>
              <tr>
                <th>
                    #
                </th>

                <th>
                    Nama
                </th>

                <th>
                    No Kartu
                </th>

                <th>
                    No. Polisi
                </th>

                <th>
                    Tanggal Masuk
                </th>

                <th>
                    Tanggal Keluar
                </th>

                <th>
                    Biaya Parkir
                </th>
              </tr>
            </thead>
            <hr>
            <tbody>
              <tr>
                <td data-label="Account">1</td>
                <td data-label="Account">Joko</td>
                <td data-label="Due Date">123123123</td>
                <td data-label="Amount">AD 1234 SS</td>
                <td data-label="Period">03/31/2016 20:00:00</td>
                <td data-label="Period">03/31/2016 22:00:00</td>
                <td data-label="Period">2000</td>
              </tr>
             
            </tbody>
          </table>

    
    </div>




    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>