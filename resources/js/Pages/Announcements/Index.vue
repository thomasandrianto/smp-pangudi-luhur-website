<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link } from "@inertiajs/vue3";

import {
    Megaphone,
    CalendarDays,
    BellRing,
    ChevronRight,
} from "lucide-vue-next";

const props = defineProps({
    announcements: {
        type: Object,
        default: () => ({
            data: [],
            links: [],
        }),
    },
});

// SAFE DATA
const announcementData = props.announcements?.data || [];
const paginationLinks = props.announcements?.links || [];
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[280px] overflow-hidden">
            <img
                :src="'/images/7851df18b123da264cc16112d769ab6a.png'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-r from-slate-900/85 to-slate-800/60"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 text-white w-fit mb-6"
                >
                    <BellRing class="w-4 h-4" />

                    Pengumuman Sekolah
                </div>

                <h1
                    class="text-4xl md:text-5xl font-black text-white leading-tight"
                >
                    Informasi & Pengumuman
                </h1>

                <p class="text-slate-200 mt-5 max-w-2xl leading-8">
                    Temukan informasi terbaru, pemberitahuan resmi, dan
                    pengumuman penting dari sekolah.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <!-- LIST -->
                <div
                    v-if="announcementData.length"
                    class="grid md:grid-cols-2 xl:grid-cols-3 gap-7"
                >
                    <article
                        v-for="item in announcementData"
                        :key="item.id"
                        class="group relative overflow-hidden rounded-[30px] border border-gray-100 bg-white shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
                    >
                        <!-- TOP -->
                        <div
                            class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"
                        ></div>

                        <div class="p-7">
                            <!-- DATE -->
                            <div class="flex items-start gap-5">
                                <div
                                    class="w-20 shrink-0 rounded-3xl bg-gradient-to-b from-blue-600 to-indigo-700 text-white flex flex-col items-center justify-center py-4 shadow-lg"
                                >
                                    <span
                                        class="text-3xl font-black leading-none"
                                    >
                                        {{ item.day }}
                                    </span>

                                    <span
                                        class="text-xs uppercase tracking-widest mt-1"
                                    >
                                        {{ item.month }}
                                    </span>

                                    <span class="text-[11px] opacity-80">
                                        {{ item.year }}
                                    </span>
                                </div>

                                <!-- CONTENT -->
                                <div class="flex-1">
                                    <div
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold mb-4"
                                    >
                                        <Megaphone class="w-3.5 h-3.5" />

                                        Pengumuman
                                    </div>

                                    <h2
                                        class="text-xl font-black text-gray-800 leading-snug group-hover:text-blue-700 transition"
                                    >
                                        {{ item.title }}
                                    </h2>
                                </div>
                            </div>

                            <!-- EXCERPT -->
                            <p class="mt-6 text-gray-600 leading-8 text-[15px]">
                                {{ item.excerpt }}
                            </p>

                            <!-- FOOTER -->
                            <div
                                class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100"
                            >
                                <div
                                    class="inline-flex items-center gap-2 text-sm text-gray-500"
                                >
                                    <CalendarDays class="w-4 h-4" />

                                    {{ item.date }}
                                </div>

                                <Link
                                    :href="`/pengumuman/${item.id}`"
                                    class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm group-hover:translate-x-1 transition"
                                >
                                    Detail

                                    <ChevronRight class="w-4 h-4" />
                                </Link>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- EMPTY -->
                <div
                    v-else
                    class="bg-white rounded-[32px] border border-dashed border-gray-200 p-20 text-center"
                >
                    <div
                        class="w-24 h-24 rounded-[28px] bg-slate-100 flex items-center justify-center mx-auto"
                    >
                        <Megaphone class="w-12 h-12 text-gray-400" />
                    </div>

                    <h2 class="text-3xl font-black text-gray-800 mt-8">
                        Belum Ada Pengumuman
                    </h2>

                    <p class="text-gray-500 mt-4 max-w-xl mx-auto leading-8">
                        Saat ini belum ada pengumuman terbaru dari sekolah.
                    </p>
                </div>

                <!-- PAGINATION -->
                <div
                    v-if="paginationLinks.length"
                    class="flex justify-center gap-2 mt-14 flex-wrap"
                >
                    <template
                        v-for="(link, index) in paginationLinks"
                        :key="index"
                    >
                        <!-- DISABLED -->
                        <span
                            v-if="!link.url"
                            v-html="link.label"
                            class="px-5 h-12 inline-flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400 text-sm font-semibold"
                        />

                        <!-- ACTIVE/LINK -->
                        <Link
                            v-else
                            :href="link.url"
                            v-html="link.label"
                            class="px-5 h-12 inline-flex items-center justify-center rounded-2xl text-sm font-bold transition-all duration-300"
                            :class="
                                link.active
                                    ? 'bg-blue-600 text-white shadow-lg'
                                    : 'bg-white border border-gray-200 text-gray-700 hover:bg-blue-50'
                            "
                        />
                    </template>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
