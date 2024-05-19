@props(['active', 'page'])

<div class="pagetitle border-bottom" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1>{{ $page }}</h1>
         <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home', ['store'=>session('selected_store')]) }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $active }}</li>
         </ol>
        </nav>
    </div>

    {{ $slot }}

</div><!-- End Page Title -->
