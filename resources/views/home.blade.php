@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Welcome to Bootstrap with Blade!</h4>
                </div>
                <div class="card-body">
                    <p>This is an example of how to integrate Bootstrap into a Laravel Blade template.</p>
                    <button class="btn btn-primary">Click Me</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Sidebar</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="#">Link 1</a></li>
                        <li><a href="#">Link 2</a></li>
                        <li><a href="#">Link 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
