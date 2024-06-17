@include('layouts.partials.dashboard.header')

<div id="layout-wrapper">

    <livewire:layout.dashboard.header/>

    <livewire:layout.dashboard.sidebar/>

    {{ $slot }}

    <livewire:layout.dashboard.rightbar/>

</div>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('layouts.partials.dashboard.footer')
