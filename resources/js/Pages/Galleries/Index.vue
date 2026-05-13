<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link } from "@inertiajs/vue3";

import { Images, Image as ImageIcon, Camera } from "lucide-vue-next";

defineProps({
    albums: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[260px] overflow-hidden">
            <img
                :src="'/images/f77b1571b572abf7fbd7692035eea969.png'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/60 to-black/50"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-pink-200 font-medium mb-3">Home / Galeri</p>

                <h1 class="text-5xl font-black text-white">Galeri Sekolah</h1>

                <p class="text-gray-200 mt-4 max-w-2xl text-lg">
                    Dokumentasi kegiatan, prestasi, dan momen terbaik sekolah.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-6">
                <!-- HEADER -->
                <div
                    class="flex items-center justify-between flex-wrap gap-4 mb-12"
                >
                    <div>
                        <h2 class="text-4xl font-black text-gray-800">
                            Album Dokumentasi
                        </h2>

                        <p class="text-gray-500 mt-3">
                            Jelajahi berbagai kegiatan sekolah kami.
                        </p>
                    </div>

                    <div
                        class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-pink-50 text-pink-700 font-bold"
                    >
                        <Images class="w-5 h-5" />

                        {{ albums.length }} Album
                    </div>
                </div>

                <!-- GRID -->
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <Link
                        v-for="album in albums"
                        :key="album.id"
                        :href="`/galleries/${album.id}`"
                        class="group"
                    >
                        <div
                            class="bg-white rounded-[32px] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500"
                        >
                            <!-- COVER -->
                            <div class="relative h-72 overflow-hidden">
                                <img
                                    :src="album.cover"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                                />

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"
                                ></div>

                                <!-- BADGE -->
                                <div
                                    class="absolute top-5 left-5 inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/20 backdrop-blur-md border border-white/20 text-white text-sm font-semibold"
                                >
                                    <Camera class="w-4 h-4" />

                                    {{ album.total_photos }} Foto
                                </div>
                            </div>

                            <!-- CONTENT -->
                            <div class="p-7">
                                <h3
                                    class="text-2xl font-black text-gray-800 group-hover:text-pink-600 transition"
                                >
                                    {{ album.name }}
                                </h3>

                                <!-- PREVIEW -->
                                <div class="flex gap-2 mt-6">
                                    <div
                                        v-for="(
                                            image, index
                                        ) in album.preview_images"
                                        :key="index"
                                        class="w-16 h-16 rounded-2xl overflow-hidden border border-white shadow-sm"
                                    >
                                        <img
                                            :src="image"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-3 mt-8 text-pink-600 font-bold"
                                >
                                    <ImageIcon class="w-5 h-5" />

                                    Lihat Album
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
