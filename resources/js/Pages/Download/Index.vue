<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link } from "@inertiajs/vue3";

import {
    Download,
    FileText,
    CalendarDays,
    HardDrive,
    ArrowDownToLine,
} from "lucide-vue-next";

defineProps({
    downloads: {
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
        <section class="relative h-[240px] overflow-hidden">
            <img
                :src="'/images/7851df18b123da264cc16112d769ab6a.png'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/60 to-black/50"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-blue-200 font-medium mb-3">Home / Download</p>

                <h1 class="text-5xl font-black text-white">Pusat Download</h1>

                <p class="text-gray-200 mt-4 max-w-2xl text-lg">
                    Unduh dokumen, formulir, dan file penting sekolah secara
                    mudah dan cepat.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-6">
                <!-- HEADER -->
                <div
                    class="flex flex-wrap items-center justify-between gap-4 mb-10"
                >
                    <div>
                        <h2 class="text-4xl font-black text-gray-800">
                            Daftar File Download
                        </h2>

                        <p class="text-gray-500 mt-3">
                            Semua file penting sekolah tersedia di sini.
                        </p>
                    </div>

                    <div
                        class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-blue-50 text-blue-700 font-bold"
                    >
                        <Download class="w-5 h-5" />

                        {{ downloads.data.length }} File
                    </div>
                </div>

                <!-- TABLE -->
                <div
                    class="bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden"
                >
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- HEAD -->
                            <thead
                                class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-gray-100"
                            >
                                <tr>
                                    <th
                                        class="px-8 py-5 text-left text-sm font-black text-gray-700"
                                    >
                                        File
                                    </th>

                                    <th
                                        class="px-6 py-5 text-left text-sm font-black text-gray-700"
                                    >
                                        Ukuran
                                    </th>

                                    <th
                                        class="px-6 py-5 text-left text-sm font-black text-gray-700"
                                    >
                                        Upload
                                    </th>

                                    <th
                                        class="px-6 py-5 text-left text-sm font-black text-gray-700"
                                    >
                                        Download
                                    </th>

                                    <th
                                        class="px-8 py-5 text-center text-sm font-black text-gray-700"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <!-- BODY -->
                            <tbody>
                                <tr
                                    v-for="file in downloads.data"
                                    :key="file.id"
                                    class="border-b border-gray-100 hover:bg-slate-50 transition"
                                >
                                    <!-- FILE -->
                                    <td class="px-8 py-6">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center shrink-0"
                                            >
                                                <FileText
                                                    class="w-7 h-7 text-blue-600"
                                                />
                                            </div>

                                            <div>
                                                <h3
                                                    class="font-black text-gray-800 leading-snug"
                                                >
                                                    {{ file.title }}
                                                </h3>

                                                <p
                                                    class="text-sm text-gray-500 mt-2 leading-6"
                                                >
                                                    {{ file.description }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- SIZE -->
                                    <td class="px-6 py-6">
                                        <div
                                            class="inline-flex items-center gap-2 text-gray-600"
                                        >
                                            <HardDrive class="w-4 h-4" />

                                            {{ file.file_size }}
                                        </div>
                                    </td>

                                    <!-- DATE -->
                                    <td class="px-6 py-6">
                                        <div
                                            class="inline-flex items-center gap-2 text-gray-600"
                                        >
                                            <CalendarDays class="w-4 h-4" />

                                            {{ file.created_at }}
                                        </div>
                                    </td>

                                    <!-- COUNT -->
                                    <td class="px-6 py-6">
                                        <div
                                            class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-100 text-gray-700 text-sm font-semibold"
                                        >
                                            <ArrowDownToLine class="w-4 h-4" />

                                            {{ file.download_count }}
                                        </div>
                                    </td>

                                    <!-- BUTTON -->
                                    <td class="px-8 py-6 text-center">
                                        <a
                                            :href="file.file_url"
                                            target="_blank"
                                            class="inline-flex items-center gap-3 px-5 h-12 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                                        >
                                            <Download class="w-5 h-5" />

                                            Download
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PAGINATION -->
                <div
                    v-if="downloads.links && downloads.links.length"
                    class="flex justify-center gap-3 pt-10 flex-wrap"
                >
                    <template
                        v-for="(link, index) in downloads.links"
                        :key="index"
                    >
                        <!-- SKIP NULL -->
                        <template v-if="link">
                            <!-- BUTTON ACTIVE / NORMAL -->
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                class="px-5 h-12 inline-flex items-center justify-center rounded-2xl border text-sm font-semibold transition-all duration-300"
                                :class="
                                    link.active
                                        ? 'bg-blue-600 text-white border-blue-600'
                                        : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50'
                                "
                            />

                            <!-- DISABLED -->
                            <span
                                v-else
                                v-html="link.label"
                                class="px-5 h-12 inline-flex items-center justify-center rounded-2xl border border-gray-100 bg-gray-100 text-gray-400 text-sm font-semibold cursor-not-allowed"
                            ></span>
                        </template>
                    </template>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
