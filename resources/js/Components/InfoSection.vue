<script setup>
import { Megaphone, CalendarDays, ArrowUpRight } from "lucide-vue-next";

import { Link } from "@inertiajs/vue3";

defineProps({
    announcements: {
        type: Array,
        default: () => [],
    },

    events: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- PENGUMUMAN -->
        <div
            class="relative overflow-hidden rounded-3xl border border-white/50 bg-white/80 backdrop-blur shadow-xl p-7"
        >
            <!-- glow -->
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-60"
            ></div>

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-6 relative z-10">
                <div class="flex items-center gap-3">
                    <div
                        class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center"
                    >
                        <Megaphone class="w-5 h-5 text-blue-600" />
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Pengumuman
                        </h2>

                        <p class="text-sm text-gray-500">
                            Informasi terbaru sekolah
                        </p>
                    </div>
                </div>

                <Link
                    href="/pengumuman"
                    class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition"
                >
                    Lihat Semua
                </Link>
            </div>

            <!-- LIST -->
            <div v-if="announcements.length" class="space-y-4 relative z-10">
                <Link
                    v-for="item in announcements"
                    :key="item.id"
                    :href="`/pengumuman/${item.id}`"
                    class="group flex gap-4 p-4 rounded-2xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/60 transition-all duration-300 hover:-translate-y-1"
                >
                    <!-- DATE -->
                    <div
                        class="w-20 shrink-0 rounded-2xl bg-gradient-to-b from-blue-500 to-blue-600 text-white shadow-lg flex flex-col items-center justify-center py-3"
                    >
                        <span class="text-2xl font-extrabold leading-none">
                            {{ item.day }}
                        </span>

                        <span
                            class="text-xs uppercase tracking-widest opacity-90"
                        >
                            {{ item.month }}
                        </span>

                        <span class="text-[11px] opacity-70">
                            {{ item.year }}
                        </span>
                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">
                        <h3
                            class="font-bold text-gray-800 text-lg group-hover:text-blue-700 transition"
                        >
                            {{ item.title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            {{ item.excerpt }}
                        </p>
                    </div>

                    <!-- ICON -->
                    <div
                        class="flex items-start text-gray-300 group-hover:text-blue-500 transition"
                    >
                        <ArrowUpRight class="w-5 h-5" />
                    </div>
                </Link>
            </div>

            <!-- EMPTY -->
            <div v-else class="text-center py-10 text-gray-400">
                Belum ada pengumuman
            </div>
        </div>

        <!-- AGENDA -->
        <div
            class="relative overflow-hidden rounded-3xl border border-white/50 bg-white/80 backdrop-blur shadow-xl p-7"
        >
            <div
                class="absolute -bottom-10 -left-10 w-32 h-32 bg-green-100 rounded-full blur-3xl opacity-60"
            ></div>

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-6 relative z-10">
                <div class="flex items-center gap-3">
                    <div
                        class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center"
                    >
                        <CalendarDays class="w-5 h-5 text-green-600" />
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Agenda Sekolah
                        </h2>

                        <p class="text-sm text-gray-500">
                            Jadwal kegiatan & acara
                        </p>
                    </div>
                </div>

                <!-- LINK -->
                <Link
                    href="/agenda"
                    class="text-sm font-semibold text-green-600 hover:text-green-700 transition"
                >
                    Lihat Semua
                </Link>
            </div>

            <!-- LIST -->
            <div v-if="events && events.length" class="space-y-4 relative z-10">
                <Link
                    v-for="item in events"
                    :key="item.id"
                    :href="`/agenda/${item.id}`"
                    class="group flex gap-4 p-4 rounded-2xl border border-gray-100 hover:border-green-200 hover:bg-green-50/60 transition-all duration-300 hover:-translate-y-1"
                >
                    <!-- DATE -->
                    <div
                        class="w-20 shrink-0 rounded-2xl bg-gradient-to-b from-green-500 to-emerald-600 text-white shadow-lg flex flex-col items-center justify-center py-3"
                    >
                        <span class="text-2xl font-extrabold leading-none">
                            {{ item.day }}
                        </span>

                        <span
                            class="text-xs uppercase tracking-widest opacity-90"
                        >
                            {{ item.month }}
                        </span>

                        <span class="text-[11px] opacity-70">
                            {{ item.year }}
                        </span>
                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">
                        <h3
                            class="font-bold text-gray-800 text-lg group-hover:text-green-700 transition"
                        >
                            {{ item.title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            {{ item.location || "Sekolah" }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ item.time }}
                        </p>
                    </div>

                    <!-- ICON -->
                    <div
                        class="flex items-start text-gray-300 group-hover:text-green-500 transition"
                    >
                        <ArrowUpRight class="w-5 h-5" />
                    </div>
                </Link>
            </div>

            <!-- EMPTY -->
            <div v-else class="text-center py-10 text-gray-400">
                Belum ada agenda
            </div>
        </div>
    </div>
</template>
