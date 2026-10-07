<section id="timeline" class="flex flex-col w-full">
    {{-- TIMELINE ITEM 1: BATTLE OF BATANGAS --}}
    <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden border-b border-[#2b1f19]">
        <img src="{{ asset('images/Battle of Bats.jpg') }}"
             class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
             :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
             @click="open = true"
             alt="Battle of Batangas">
        <div x-show="!open"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = true"
             class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
            <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1901</h2>
            <p class="text-xl text-white md:text-2xl font-mono tracking-wider uppercase mt-2 drop-shadow-md hero-description">BATTLE OF BATANGAS</p>
            <div class="mt-12 flex items-center text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                <span>CLICK PHOTO TO READ</span>
            </div>
        </div>
        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
            <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                <button @click="open = false" class="absolute top-4 right-6 text-xl font-bold hover:text-red-700 transition" title="Close">×</button>
                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">BATTLE OF BATANGAS</h3>
                    <p class="text-sm font-bold text-[#634e40]">1901</p>
                </div>
                <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner">
                    <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>
                    <p class="text-justify">
                        In late 1901, Brigadier General J. Franklin Bell assumed command of American forces in the region to suppress the Filipino resistance led by General Miguel Malvar. Following a brief December offensive by Malvar's forces against several garrisons, Bell responded with a sweeping and aggressive counter-insurgency campaign. The U.S. military enforced a strict concentration policy, forcing civilians into designated town zones while troops destroyed standing crops, burned thousands of tons of palay, and slaughtered livestock outside the zones to starve out the guerrillas. The resulting overcrowded and unsanitary conditions inside the camps, combined with severe food shortages, sparked a massive mortality crisis in Batangas dominated by a malaria epidemic. Concurrently, American commanders incarcerated local elite leaders and captured soldiers, using pressure tactics to turn them into informers who exposed guerrilla hiding places and support networks. As his subordinate officers were systematically captured or forced to surrender, Malvar became isolated in the mountains without a staff, food, or serviceable weapons. Realizing that continued fighting would prevent rice planting and cause widespread famine among the populace, Malvar marched into Lipa and surrendered to General Bell on April 16, 1902. With the remaining guerrilla leaders following suit, Bell reopened local ports and restored Batangas to civilian control, officially concluding the battle for Batangas by the first week of May 1902.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TIMELINE ITEM 2: JAPANESE ATROCITIES --}}
    <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden border-b border-[#2b1f19]">
        <img src="{{ asset('images/Japanese Bats.jpg') }}"
             class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
             :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
             @click="open = true"
             alt="Japanese Atrocities">

        <div x-show="!open"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = true"
             class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
            <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1945</h2>
            <p class="text-xl text-white md:text-2xl tracking-wider uppercase mt-2 drop-shadow-md hero-description">JAPANESE ATROCITIES</p>
            <div class="mt-12 flex items-center text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                <span>CLICK PHOTO TO READ</span>
            </div>
        </div>

        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
            <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                <button @click="open = false" class="absolute top-4 right-6 text-2xl font-bold hover:text-red-700 transition" title="Close">×</button>

                <div class="text-center mb-4 flex-shrink-0">
                    <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">JAPANESE ATROCITIES</h3>
                    <p class="text-sm font-bold text-[#634e40]">1945</p>
                </div>

                <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner space-y-4">
                    <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>

                    {{-- Section: Overview --}}
                    <div>
                        <h4 class="font-bold text-sm text-[#f2e2d0] border-b border-[#6a5042] pb-1 uppercase tracking-wide">The Batangas Massacres: The Civilian Toll of War</h4>
                        <p class="mt-2 text-justify">
                            During World War II, the Japanese Imperial Army conducted brutal operations against suspected Filipino guerrillas in the province of Batangas. However, the primary victims were innocent civilians, leading to devastated families and destroyed communities across Lipa, Bauan, and Taal.
                        </p>
                        <p class="mt-2 text-justify">
                            In the town of Bauan, male residents were rounded up inside a church, moved to a nearby house, and killed in an orchestrated explosion before the town was burned. While Japanese forces claimed they were responding to guerrilla activity, Filipino survivors confirmed the victims were non-combatants with no involvement in the resistance.
                        </p>
                    </div>

                    {{-- Section: Survivor Stories --}}
                    <div>
                        <h4 class="font-bold text-sm text-[#f2e2d0] border-b border-[#6a5042] pb-1 uppercase tracking-wide">Survivor Stories: The Human Cost</h4>
                        <div class="mt-3 space-y-3">
                            <div class="bg-[#3b2b23] p-3 rounded border-l-2 border-[#d0beaa]">
                                <p class="font-bold text-[#f2e2d0]">Maria’s Account</p>
                                <p class="text-justify mt-1">
                                    Maria’s husband and brothers were killed by Japanese soldiers. During the attack, she was stabbed with a bayonet and suffered severe burns when soldiers set fire to her clothing and home. Her physical injuries took more than nine years to heal completely.
                                </p>
                            </div>

                            <div class="bg-[#3b2b23] p-3 rounded border-l-2 border-[#d0beaa]">
                                <p class="font-bold text-[#f2e2d0]">Geronimo Madlambayan’s Account</p>
                                <p class="text-justify mt-1">
                                    Geronimo lost his eyesight during the catastrophic bombing in Bauan. Though he carried permanent physical and emotional scars, he later navigated the complex path of post-war reconciliation, eventually developing a friendship with a Japanese engineer.
                                </p>
                            </div>

                            <div class="bg-[#3b2b23] p-3 rounded border-l-2 border-[#d0beaa]">
                                <p class="font-bold text-[#f2e2d0]">Pedro Alafo’s Account</p>
                                <p class="text-justify mt-1">
                                    Pedro lost his father and three uncles in the Bauan explosion. Forced to abandon his education, he entered the workforce prematurely to support his remaining family.
                                </p>
                            </div>

                            <div class="bg-[#3b2b23] p-3 rounded border-l-2 border-[#d0beaa]">
                                <p class="font-bold text-[#f2e2d0]">The Wider Community</p>
                                <p class="text-justify mt-1">
                                    Countless other residents shared similar fates—losing family members, homes, and future opportunities during the retreat of Imperial forces.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Lasting Effects --}}
                    <div>
                        <h4 class="font-bold text-sm text-[#f2e2d0] border-b border-[#6a5042] pb-1 uppercase tracking-wide">The Lasting Effects of Occupation</h4>
                        <ul class="list-disc list-inside mt-2 space-y-1 text-justify">
                            <li><strong class="text-[#f2e2d0]">Shattered Families:</strong> Sudden loss of parents, siblings, and spouses.</li>
                            <li><strong class="text-[#f2e2d0]">Economic Ruin:</strong> Widespread poverty and daily struggles to survive.</li>
                            <li><strong class="text-[#f2e2d0]">Stolen Futures:</strong> Interrupted education and lost career opportunities.</li>
                            <li><strong class="text-[#f2e2d0]">Physical Toll:</strong> Permanent disabilities and long-term health consequences.</li>
                            <li><strong class="text-[#f2e2d0]">Psychological Trauma:</strong> Decades of emotional distress, fear, and grief.</li>
                        </ul>
                    </div>

                    {{-- Section: Accountability & Forgiveness --}}
                    <div>
                        <h4 class="font-bold text-sm text-[#f2e2d0] border-b border-[#6a5042] pb-1 uppercase tracking-wide">Accountability and Forgiveness</h4>
                        <p class="mt-2 text-justify">
                            While former Japanese soldiers often cited military orders or defense against guerrillas, Filipino survivor accounts emphasize the deliberate targeting of non-combatants, holding both high commanders and individual soldiers accountable.
                        </p>
                        <ul class="list-disc list-inside mt-2 space-y-1 text-justify">
                            <li><strong class="text-[#f2e2d0]">Enduring Trauma:</strong> Many survivors carried lifetime resentment toward the perpetrators.</li>
                            <li><strong class="text-[#f2e2d0]">Conditional Forgiveness:</strong> Others offered forgiveness to those who sincerely acknowledged their actions.</li>
                            <li><strong class="text-[#f2e2d0]">Remembering the Past:</strong> Forgiveness never meant forgetting the lives lost or the suffering endured.</li>
                        </ul>
                    </div>

                    {{-- Section: Main Message --}}
                    <div>
                        <h4 class="font-bold text-sm text-[#f2e2d0] border-b border-[#6a5042] pb-1 uppercase tracking-wide">Main Message</h4>
                        <p class="mt-2 text-justify">
                            War does not end when the fighting stops; its consequences echo through generations. Through the experiences of Filipino civilians in Taal, Bauan, and across Batangas, history teaches the essential duty of honoring victims, seeking historical truth, and understanding the profound human cost of conflict.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- TIMELINE ITEM 3: THE SUBLIAN --}}
    <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden">
        <img src="{{ asset('images/Sublian.png') }}"
             class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
             :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
             @click="open = true"
             alt="The Sublian">
        <div x-show="!open"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = true"
             class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
            <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1988</h2>
            <p class="text-xl text-white md:text-2xl tracking-wider uppercase mt-2 drop-shadow-md hero-description">THE SUBLIAN</p>
            <div class="mt-12 flex items-center text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                <span>CLICK PHOTO TO READ</span>
            </div>
        </div>
        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
            <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                <button @click="open = false" class="absolute top-4 right-6 text-xl font-bold hover:text-red-700 transition" title="Close">×</button>
                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">THE SUBLIAN</h3>
                    <p class="text-sm font-bold text-[#634e40]">1988</p>
                </div>
                <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner">
                    <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>
                    <p class="text-justify mb-3">
                        According to the official website of Batangas City, The Sublian Festival was started by the city Mayor Eduardo Dimacuha on July 23, 1988 on the annual observation of the city hood of Batangas City. The objective is to renew the practice of the subli.
                    </p>
                    <p class="text-justify font-bold mb-2 text-[#f2e2d0]">So, what is a subli?</p>
                    <p class="text-justify">
                        A subli is offered at a feast, as a ceremonial worship dance in honor of the Holy Cross. The image of the Holy Cross was found during the Spanish rule in the town of Alitagtag. It is the patron saint of ancient town of Bauan. The dance is indigenous to the province of Batangas. The subli consists of long prayers, songs and dances which are arranged in a fixed order. The dancers are made up of one, two or eight couples. The male dancers shuffle in intense fashion and hit the ground using a bamboo stick, while the female, dance with a sophisticated wrist and finger movement. The parade usually starts in morning on the 23rd of July after the floral offering. It is commonly participated by the city government employees, non-government organization, schools and socio-civic organization. The participants wear their native clothes with their subli hats decorated to represent Batangueño characteristics and traditions. The highlight of the event is the Foundation Day and the Sublian sa Kalye (in the street) where participants will march and dance the subli in the streets. There are around a thousand students who join and perform a street dancing subli. The parade usually takes at least an hour or more to complete. After the Sublian Parade, programs are scheduled for the whole day at the City Hall Complex. One interesting program during the celebration is the Lupakan (making of a snack called nilupak) at Awitan (singing) held at the People's Quadrangle. Here you can catch a glimpse of how the native snack nilupak is made. And at the same time have a taste of the delectable snack. (Source: batangas-philippines.com)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>