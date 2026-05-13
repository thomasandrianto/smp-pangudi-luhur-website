<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { ref } from "vue";

import { Images, X } from "lucide-vue-next";

const props = defineProps({
    album: Object,
});

const selectedImage = ref(null);

const openImage = (image) => {
    selectedImage.value = image;
};

const closeImage = () => {
    selectedImage.value = null;
};
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[260px] overflow-hidden">
            <img
                :src="album.cover"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/60 to-black/50"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-pink-200 font-medium mb-3">Home / Galeri</p>

                <h1 class="text-5xl font-black text-white">
                    {{ album.name }}
                </h1>

                <div class="inline-flex items-center gap-3 mt-5 text-white/90">
                    <Images class="w-5 h-5" />

                    {{ album.photos.length }} Foto
                </div>
            </div>
        </section>

        <!-- GALLERY -->
        <section class="py-16 bg-slate-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-6">
                <div
                    class="columns-1 md:columns-2 xl:columns-3 gap-6 space-y-6"
                >
                    <div
                        v-for="photo in album.photos"
                        :key="photo.id"
                        class="break-inside-avoid group cursor-pointer"
                        @click="openImage(photo.image)"
                    >
                        <div
                            class="overflow-hidden rounded-[28px] bg-white border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500"
                        >
                            <img
                                :src="photo.image"
                                class="w-full object-cover group-hover:scale-105 transition duration-700"
                            />

                            <div class="p-5">
                                <h3
                                    class="font-black text-gray-800 leading-snug"
                                >
                                    {{ photo.title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- LIGHTBOX -->
        <div
            v-if="selectedImage"
            class="fixed inset-0 z-[999] bg-black/90 flex items-center justify-center p-6"
            @click="closeImage"
        >
            <button
                class="absolute top-6 right-6 w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md text-white flex items-center justify-center"
            >
                <X class="w-7 h-7" />
            </button>

            <img
                :src="selectedImage"
                class="max-w-full max-h-full rounded-3xl shadow-2xl"
            />
        </div>
    </MainLayout>
</template>
