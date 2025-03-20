<div class="flex justify-between items-center w-full ">
    <div class="flex">
        <img src="{{ asset('images/banner.png') }}" alt="Banner de la Empresa" class=" w-20 h-14">
         <div  class=" text-3xl">Bicicleteria Balsamo</div>
    </div>
    <div class="flex ">
        @livewire('user-info')
        @include('components.RealTimeClock')
    </div>

</div>

