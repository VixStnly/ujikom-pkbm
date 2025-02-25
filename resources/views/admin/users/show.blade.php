@include('content.html')

<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Detail User: {{ $user->name }}</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Detail User</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mx-auto mt-10 p-6 bg-gray-100 shadow-lg rounded-lg mb-5">
                <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Detail User</h2>

                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <div class="mb-2">
                        <h3 class="font-semibold text-lg">INFORMASI ACCOUNT:</h3>
                        <strong class="text-gray-700">Email:</strong> 
                        <span class="text-gray-600">{{ $user->email }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">NISN/NIP:</strong> 
                        <span class="text-gray-600">{{ $user->nisn_nip }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Role:</strong> 
                        <span class="text-gray-600">{{ $user->role->name }}</span>
                    </div>
                    
                    <!-- Divider -->
                    <hr class="my-4 border-gray-400" />

                    <!-- Kelas Information -->
                    <h4 class="font-semibold text-lg text-gray-800 mt-3">KELAS:</h4>
                    <div class="d-flex flex-wrap mt-2"> 
                        @foreach($user->kelas as $kelas)
                            <div class="mb-3 me-2"> <!-- Margin end for spacing -->
                                <span class="chip chip-outline-secondary d-inline-flex align-items-center"> 
                                    <i class="material-icons icon--left">school</i> 
                                    {{ $kelas->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                  <!-- Mata Pelajaran Information -->
<h4 class="font-semibold text-lg text-gray-800 mt-4">MATA PELAJARAN:</h4>
<div class="d-flex flex-wrap mt-2">
    @foreach($user->subjects as $subject)
        <div class="mb-3 me-2">
            <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                <i class="material-icons icon--left">book</i>
                {{ $subject->name }} - {{ $subject->kelas ? $subject->kelas->name : 'N/A' }}
            </span>
        </div>
    @endforeach
</div>

                    <!-- Guru Information -->
                 <!-- Guru Information -->
                 @if($user->role_id == 4) <!-- Menampilkan hanya jika role_id 4 (misalnya Siswa) -->

<h4 class="font-semibold text-lg text-gray-800 mt-4">GURU YANG MENGAJAR:</h4>
<div class="d-flex flex-wrap mt-2">
   
        @foreach($user->guru as $gurus) <!-- Mengecek apakah ada guru yang terkait -->
            <div class="mb-3 me-2">
                <span class="chip chip-outline-secondary d-inline-flex align-items-center"> 
                    <i class="material-icons icon--left">person</i> 
                    {{ $gurus->name }} ({{ $gurus->role->name }})
                </span>
            </div>
        @endforeach
  
</div>
@endif

                </div>
            </div>
            <!-- END Content Section -->

            @include('guru.footer')
        </div>
        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')
</body>
