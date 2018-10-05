@extends('layout')

@section('content')
    @if(is_array( $addresses ))
        <h3>We found {{ count( $addresses ) }} record(s)</h3>
        @foreach($addresses as $address)
            <table>
                <tr>
                    <th>Formatted Address:</th>
                    <td>{{ $address->formatted_address }}</td>
                </tr>

                @foreach($address->address_components as $component)
                    <tr>
                        <th>{{ ucfirst( $component->types[0] ) }}:</th>
                        <td>{{ $component->long_name }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
        <h3>Raw data:</h3>
        <pre>{{ var_dump( $addresses ) }}</pre>
    @else
        <h3>We couldn't find any result</h3>
        <h5>{{ $addresses }}</h5>
    @endif
@endsection