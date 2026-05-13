<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { usePage } from "@inertiajs/vue3";
import { ChevronLeft, ChevronRight } from "lucide-vue-next";

const page = usePage();

const appName = page.props.appName;

// SLIDES
const slides = [
    {
        image: "/images/7851df18b123da264cc16112d769ab6a.png",

        title: "Tanah yang tidak diolah, betapapun suburnya",

        subtitle:
            "akan menghasilkan duri dan semak; demikian pula pikiran manusia",
    },

    {
        image: "/images/c178fe76fb53d7db85f40ade4100898e.png",

        title: "Ajining raga saka busana,",

        subtitle: "ajining diri saka lathi",
    },

    {
        image: "/images/f77b1571b572abf7fbd7692035eea969.png",

        title: "Belajar adalah cara kita mengasah talenta yang Tuhan anugerahkan",

        subtitle:
            "dan doa adalah cara kita mengembalikan kemuliaan itu kepada-Nya.",
    },
];

const current = ref(0);

let interval = null;

// NEXT
const next = () => {
    current.value = (current.value + 1) % slides.length;
};

// PREV
const prev = () => {
    current.value = (current.value - 1 + slides.length) % slides.length;
};

// AUTO SLIDE
onMounted(() => {
    interval = setInterval(next, 5000);
});

onBeforeUnmount(() => {
    clearInterval(interval);
});
</script>

<template>
    <section class="relative w-full h-[85vh] min-h-[650px] overflow-hidden">
        <!-- SLIDES -->
        <div
            v-for="(slide, index) in slides"
            :key="index"
            class="absolute inset-0 transition-all duration-1000"
            :class="
                current === index
                    ? 'opacity-100 scale-100'
                    : 'opacity-0 scale-110'
            "
        >
            <!-- IMAGE -->
            <img :src="slide.image" class="w-full h-full object-cover" />

            <!-- DARK OVERLAY -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/60"
            ></div>
        </div>

        <!-- CINEMATIC GLOW -->
        <div
            class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-500/20 blur-3xl rounded-full"
        ></div>

        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-500/20 blur-3xl rounded-full"
        ></div>

        <!-- CONTENT -->
        <div class="absolute inset-0 z-10 flex items-center">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
                <div class="max-w-4xl">
                    <!-- SCHOOL NAME -->
                    <div
                        class="mb-6 inline-flex items-center rounded-full border border-white/20 bg-white/10 backdrop-blur-md px-5 py-2 text-sm text-white shadow-xl"
                    >
                        SMP Pangudi Luhur Kalibawang
                    </div>

                    <!-- TITLE -->
                    <transition
                        mode="out-in"
                        enter-active-class="transition duration-700 ease-out"
                        enter-from-class="opacity-0 translate-y-8"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition duration-300 ease-in"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div :key="current">
                            <h1
                                class="text-4xl md:text-6xl lg:text-7xl font-black leading-tight text-white"
                                style="
                                    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.45);
                                "
                            >
                                {{ slides[current].title }}
                            </h1>

                            <!-- SUBTITLE -->
                            <p
                                class="mt-6 text-xl md:text-2xl text-gray-200 leading-relaxed max-w-3xl font-light"
                                :class="
                                    current === 2 ? 'italic tracking-wide' : ''
                                "
                            >
                                {{ slides[current].subtitle }}
                            </p>

                            <!-- ACCENT LINE -->
                            <div
                                class="mt-8 w-32 h-1 rounded-full bg-gradient-to-r from-yellow-300 via-orange-300 to-yellow-400"
                            ></div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>

        <!-- PREV -->
        <button
            @click="prev"
            class="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full border border-white/20 bg-white/10 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl"
        >
            <ChevronLeft class="w-6 h-6" />
        </button>

        <!-- NEXT -->
        <button
            @click="next"
            class="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full border border-white/20 bg-white/10 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-xl"
        >
            <ChevronRight class="w-6 h-6" />
        </button>

        <!-- DOT INDICATOR -->
        <div
            class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3"
        >
            <button
                v-for="(item, index) in slides"
                :key="index"
                @click="current = index"
                class="rounded-full transition-all duration-300"
                :class="
                    current === index
                        ? 'w-10 h-3 bg-white'
                        : 'w-3 h-3 bg-white/40 hover:bg-white/70'
                "
            ></button>
        </div>

        <!-- BOTTOM FADE -->
        <div
            class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-white via-white/80 to-transparent"
        ></div>
    </section>
</template>
