<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link } from "@inertiajs/vue3";

import { CalendarDays, MapPin, Clock3, ChevronRight } from "lucide-vue-next";

defineProps({
    event: {
        type: Object,
        default: () => ({}),
    },

    latestEvents: {
        type: Array,
        default: () => [],
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
                class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"
            ></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-white">
                <div
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 mb-8"
                >
                    <CalendarDays class="w-5 h-5" />

                    Agenda Sekolah
                </div>

                <h1
                    class="text-4xl md:text-6xl font-black max-w-4xl leading-tight"
                >
                    {{ event.title }}
                </h1>

                <!-- META -->
                <div class="flex flex-wrap gap-6 mt-8 text-white/80">
                    <div class="flex items-center gap-2">
                        <CalendarDays class="w-5 h-5" />

                        {{ event.date_range }}
                    </div>

                    <div class="flex items-center gap-2">
                        <MapPin class="w-5 h-5" />

                        {{ event.location || "Sekolah" }}
                    </div>

                    <div class="flex items-center gap-2">
                        <Clock3 class="w-5 h-5" />

                        {{ event.time || "-" }}
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-10">
                <!-- MAIN -->
                <div class="lg:col-span-8">
                    <article
                        class="bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden"
                    >
                        <div class="p-8 md:p-12">
                            <div
                                class="prose prose-lg max-w-none prose-headings:font-black prose-p:text-gray-600 prose-p:leading-8"
                            >
                                <p>
                                    {{ event.description }}
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- SIDEBAR -->
                <aside class="lg:col-span-4">
                    <div
                        class="bg-white rounded-[32px] border border-gray-100 shadow-sm p-8"
                    >
                        <h3 class="text-2xl font-black text-gray-800 mb-6">
                            Agenda Lainnya
                        </h3>

                        <div class="space-y-5">
                            <Link
                                v-for="item in latestEvents"
                                :key="item.id"
                                :href="`/agenda/${item.id}`"
                                class="group flex items-start justify-between gap-4"
                            >
                                <div>
                                    <h4
                                        class="font-bold text-gray-800 group-hover:text-green-600 transition"
                                    >
                                        {{ item.title }}
                                    </h4>

                                    <p class="text-sm text-gray-400 mt-2">
                                        {{ item.date_range }}
                                    </p>
                                </div>

                                <ChevronRight
                                    class="w-5 h-5 text-gray-300 group-hover:text-green-500 transition"
                                />
                            </Link>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
