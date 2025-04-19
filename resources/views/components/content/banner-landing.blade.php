<div class="page-section border-bottom-2" style="background-image: url('{{ asset('images/banner-landing.jpg') }}'); background-size: cover; background-position: center; padding-bottom: 50px;">
    <div class="container page__container">
        <div class="d-flex flex-column align-items-center text-center">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
    .breadcrumb-item::before {
        color: white !important;
    }
    .breadcrumb-item i {
        color: white !important;
    }
</style>