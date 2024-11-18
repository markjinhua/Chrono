
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <    style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;


        fo       nt       -size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box t    able {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table t    d {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:    nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top tab    le td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table t    d.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table     td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
            background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        paddin    g-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom:     1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-botto    m: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-    top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box t    able tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Hel    vetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
            text-align: left;
    }
    </style>
</head>

<bod    y>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                <?php $site=DB::table('site_settings')->first();
                $id=app('request')->input('id') ;

$qry=DB::table('cashout_request as c')->select('c.id','p.name','c.created_at','c.amount','c.method','c.status')->join('publishers as p','p.id','=','c.affliate_id')->where('c.id',$id)->first();

                ?>
                                <img src="{{asset('site_images')}}/{{$site->logo}}"  style="width:100%; max-width:300px;">
                            </td>

                            <td style="text-align: left">
                                Invoice #: {{$qry->id}}<br>
                                Publisher Name : {{$qry->name}}<br>
                                Date: {{$qry->created_at}}<br>

                            </td>
                        </tr>
                    </table>
                </td>
                                          </tr>


            <tr class="heading">
                <td>
                    Payment Method
                </td>

                            <        td>
                    Status
                </td>
            </tr>

            <tr class="details">
                                <td>
                    {{$qry->method}}
                 </td>

                <td>
                                  {{$qry->status}}
                </td>
            </tr>

            <tr class="heading">
                                <td>
                    Title
                </td>

                <td>
                    Amoun            t
                </td>
            </tr>

            <tr class="item">
                <td>
                                  Payable Amount
                </td>

                <td>
                     ${{$qry->amount}}
                </td>
            </tr>


            <tr class="heading">
                <td></td>

                                <td>
                   Total:  ${{$qry->amount}}
                </td>
            </tr>
                                 </table>
        <div >

    </div>
</div>
</body>
</html>
