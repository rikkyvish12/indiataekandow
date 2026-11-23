<!DOCTYPE html>
<html>

<head>
    <title>Welcome to TFI</title>
    <style>
        #tfi_table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tfi_table td,
        #tfi_table th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        #tfi_table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #tfi_table tr:hover {
            background-color: #ddd;
        }

        #tfi_table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: grey;
            color: white;
        }

    
    </style>
</head>

<body>
   <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
            @foreach ($data as $key => $value)
                <tr>
                    <th> Full-Name</th>
                    <td> {{$value['full_name']}}</td>
                </tr>
                <tr>

                    <th> Email</th>
                    <td> {{$value['email']}}</td>
                </tr>
            

                <tr>

                    <th> Contact</th>
                    <td> {{$value['contact']}}</td>
                </tr>
                
                <tr>


                <tr>
                    <th>Subject</th>
                    <td> {{$value['subject']}}</td>
                </tr>
                

                    <th>Message</th>
                    <td> {{$value['message']}}</td>

                </tr>


            @endforeach

        @endif


    </table>



    <p>(Note: Auto-generated e-mail, please don't reply)</p>



</body>

</html>
