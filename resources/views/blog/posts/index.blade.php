@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <table>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection