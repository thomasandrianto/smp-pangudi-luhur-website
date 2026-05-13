<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link } from "@inertiajs/vue3";

import { CalendarDays, MapPin, Clock3, ChevronRight } from "lucide-vue-next";

const props = defineProps({
    events: {
        type: Object,
        default: () => ({
            data: [],
            links: [],
        }),
    },
});
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-emerald-700 via-green-700 to-slate-900 py-24"
        >
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"
            ></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-white">
                <div
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 mb-8"
                >
                    <CalendarDays class="w-5 h-5" />

                    Agenda Sekolah
                </div>

                <h1
                    class="text-5xl md:text-6xl font-black max-w-4xl leading-tight"
                >
                    Agenda & Kegiatan Sekolah
                </h1>

                <p class="mt-6 text-lg text-white/80 max-w-2xl">
                    Informasi kegiatan, acara, dan agenda resmi SMP PL
                    Kalibawang.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <!-- LIST -->
                <div
                    v-if="events.data.length"
                    class="grid lg:grid-cols-2 gap-8"
                >
                    <Link
                        v-for="item in events.data"
                        :key="item.id"
                        :href="`/agenda/${item.id}`"
                        class="group bg-white rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hover:-translate-y-1"
                    >
                        <div class="p-8 flex gap-6">
                            <!-- DATE -->
                            <div
                                class="w-24 shrink-0 rounded-3xl bg-gradient-to-b from-green-500 to-emerald-600 text-white flex flex-col items-center justify-center py-5 shadow-lg"
                            >
                                <span class="text-4xl font-black leading-none">
                                    {{ item.day }}
                                </span>

                                <span
                                    class="text-sm uppercase tracking-widest mt-2"
                                >
                                    {{ item.month }}
                                </span>

                                <span class="text-xs opacity-80 mt-1">
                                    {{ item.year }}
                                </span>
                            </div>

                            <!-- CONTENT -->
                            <div class="flex-1">
                                <h2
                                    class="text-2xl font-black text-gray-800 group-hover:text-green-700 transition leading-snug"
                                >
                                    {{ item.title }}
                                </h2>

                                <p
                                    class="text-gray-500 mt-4 leading-7 line-clamp-3"
                                >
                                    {{ item.description }}
                                </p>

                                <!-- META -->
                                <div class="space-y-3 mt-6">
                                    <div
                                        class="flex items-center gap-3 text-gray-500 text-sm"
                                    >
                                        <MapPin class="w-4 h-4" />

                                        {{ item.location || "Sekolah" }}
                                    </div>

                                    <div
                                        class="flex items-center gap-3 text-gray-500 text-sm"
                                    >
                                        <Clock3 class="w-4 h-4" />

                                        {{ item.time || "-" }}
                                    </div>
                                </div>

                                <!-- BUTTON -->
                                <div
                                    class="inline-flex items-center gap-2 mt-7 text-green-600 font-bold"
                                >
                                    Lihat Detail

                                    <ChevronRight
                                        class="w-5 h-5 group-hover:translate-x-1 transition"
                                    />
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- EMPTY -->
                <div
                    v-else
                    class="bg-white rounded-[32px] border border-dashed border-gray-200 py-20 text-center"
                >
                    <CalendarDays class="w-14 h-14 text-gray-300 mx-auto" />

                    <h3 class="text-3xl font-black text-gray-700 mt-6">
                        Belum Ada Agenda
                    </h3>

                    <p class="text-gray-500 mt-3">
                        Agenda sekolah akan tampil di sini.
                    </p>
                </div>

                <!-- PAGINATION -->
                <div
                    v-if="events.links.length"
                    class="flex flex-wrap justify-center gap-3 mt-14"
                >
                    <Link
                        v-for="(link, index) in events.links"
                        :key="index"
                        :href="link.url || '#'"
                        v-html="link.label"
                        class="min-w-[44px] h-11 px-4 rounded-2xl flex items-center justify-center border text-sm font-semibold transition"
                        :class="[
                            link.active
                                ? 'bg-green-600 border-green-600 text-white'
                                : 'bg-white border-gray-200 text-gray-700 hover:border-green-400 hover:text-green-600',

                            !link.url ? 'opacity-50 pointer-events-none' : '',
                        ]"
                    />
                </div>
            </div>
        </section>
    </MainLayout>
</template>
