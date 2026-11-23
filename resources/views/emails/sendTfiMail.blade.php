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
    @switch($form_name)
    @case('individual')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>

        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>

            <th>Identity</th>
            <td> {{$value['identity']}}</td>

        </tr>
        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>


        @endforeach

        @endif


    </table>

    @break

    @case('sponsor')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>
        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>


        <tr>
            <th>Org-Name</th>
            <td> {{$value['org_name']}}</td>
        </tr>
        <tr>
            <th>Designation</th>
            <td> {{$value['designation']}}</td>
        </tr>
        <tr>
            <th>Website</th>
            <td> {{$value['website']}}</td>
        </tr>
        <tr>

            <th>Message</th>
            <td> {{$value['message']}}</td>

        </tr>


        @endforeach

        @endif


    </table>
    @break


    @case('academy')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>
        <tr>
            <th>Club-Full-Name</th>
            <td> {{$value['full_name_club']}}</td>

        </tr>

        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>


        <tr>
            <th>Designation</th>
            <td> {{$value['designation']}}</td>
        </tr>
        <tr>
            <th>Website</th>
            <td> {{$value['website']}}</td>
        </tr>
        <tr>
            <th>Social-Media</th>
            <td> {{$value['social_media']}}</td>
        </tr>
        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>


        <tr>

            <th>Message</th>
            <td> {{$value['message']}}</td>

        </tr>


        @endforeach

        @endif


    </table>
    @break


    @case('district')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>

        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>


        <tr>
            <th>Website</th>
            <td> {{$value['website']}}</td>
        </tr>
        <tr>
            <th>Social-Media</th>
            <td> {{$value['social_media']}}</td>
        </tr>

        <tr>
            <th>District</th>
            <td> {{$value['district']}}</td>
        </tr>
        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>

        <tr>

            <th>Message</th>
            <td> {{$value['message']}}</td>

        </tr>


        @endforeach

        @endif


    </table>
    @break

    @case('state')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>

        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>

        <tr>
            <th>Website</th>
            <td> {{$value['website']}}</td>
        </tr>
        <tr>
            <th>Social-Media</th>
            <td> {{$value['social_media']}}</td>
        </tr>

        <tr>
            <th>District</th>
            <td> {{$value['district']}}</td>
        </tr>
        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>

        <tr>

            <th>Message</th>
            <td> {{$value['message']}}</td>

        </tr>


        @endforeach

        @endif


    </table>
    @break


    @case('volunteer')
    <table id="tfi_table" class="table table-boredered" style="margin-right:10px">
        @if(isset($data))
        @foreach ($data as $key => $value)
        <tr>

            <th> Full-Name</th>
            <td> {{$value['full_name']}}</td>
        </tr>

        <tr>
            <th> State</th>
            <td> {{$value['state']}}</td>
        </tr>
        <tr>

            <th> Contact</th>
            <td> {{$value['contact']}}</td>
        </tr>
        <tr>

            <th> Email</th>
            <td> {{$value['email']}}</td>
        </tr>
        <tr>
            <th> Address</th>
            <td> {{$value['address']}}</td>
        </tr>





        @endforeach

        @endif


    </table>
    @break

    @default
    <span>Something went wrong, please try again</span>
    @endswitch



    <p>(Note: Auto-generated e-mail, please don't reply)</p>



</body>

</html>
