<!-- VIRTUAL REALITY SECTION -->
<section id="vr" class="w-full bg-[#2b1f19] flex flex-col">
    <!-- BANNER HEADER -->
    <div class="bg-[#3b2b23] text-center py-3 border-b border-[#2b1f19]">
        <h2 class="text-xl md:text-2xl tracking-widest text-[#ebdcd0] uppercase font-bold">
            VR SCENES OF BATANGAS HISTORY & CULTURE
        </h2>
    </div>

    <!-- VR SCENES LIST -->
    <div class="flex flex-col w-full">
        <!-- SCENE 1: 1901 BATTLE OF BATANGAS -->
        <div class="vr-card relative min-h-[450px] md:min-h-[500px] bg-cover bg-center flex flex-col items-center justify-center text-center p-6 border-b-2 border-[#1a120e]" 
             style="background-image: url('{{ asset('images/Battle of Bats.jpg') }}');">
            <!-- Dark Overlay for Contrast -->
            <div class="absolute inset-0 bg-black/40"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center">
                <h2 class="text-6xl md:text-7xl font-bold tracking-widest text-[#fcfbf9] drop-shadow-md">
                    1901
                </h2>
                <p class="text-xl md:text-2xl tracking-wider uppercase text-[#ebdcd0] mt-2 mb-6 drop-shadow-md hero-description">
                    BATTLE OF BATANGAS
                </p>
                <a href="{{ route('vr.show', ['scene' => '1901-battle-of-batangas']) }}" class="btn-vr-enter">
                    ENTER VR
                </a>
            </div>
        </div>

        <!-- SCENE 2: 1988 THE SUBLIAN -->
        <div class="vr-card relative min-h-[450px] md:min-h-[500px] bg-cover bg-center flex flex-col items-center justify-center text-center p-6" 
             style="background-image: url('{{ asset('images/Sublian.png') }}');">
            <!-- Dark Overlay for Contrast -->
            <div class="absolute inset-0 bg-black/35"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center">
                <h2 class="text-6xl md:text-7xl font-bold tracking-widest text-[#fcfbf9] drop-shadow-md">
                    1988
                </h2>
                <p class="text-xl md:text-2xl tracking-wider uppercase text-[#ebdcd0] mt-2 mb-6 drop-shadow-md hero-description">
                    THE SUBLIAN
                </p>
                <a href="{{ route('vr.show', ['scene' => '1988-the-sublian']) }}" class="btn-vr-enter">
                    ENTER VR
                </a>
            </div>
        </div>
    </div>
</section>