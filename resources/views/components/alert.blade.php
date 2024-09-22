@if (session('success'))
<div id="" class="flash-message rounded-md flex items-center px-5 py-4 bg-theme-18 text-theme-9 shadow-lg transition-opacity duration-500">
    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div id="" class="flash-message rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6 shadow-lg transition-opacity duration-500">
    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
    {{ session('error') }}
</div>
@endif
@if($errors->any())
<div id="" class="flash-message rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6 shadow-lg transition-opacity duration-500">
    <i data-feather="alert-triangle" class="w-10 h-10 mr-10"></i>
    <ul class="list-disc ml-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


