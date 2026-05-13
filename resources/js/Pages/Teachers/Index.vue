<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

defineProps({
    teachers: {
        type: Object,
        default: () => ({
            data: [],
        }),
    },
});
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[260px] overflow-hidden">
            <!-- IMAGE -->
            <img
                :src="'/images/guru.jpg'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <!-- OVERLAY -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/60 to-black/50"
            ></div>

            <!-- CONTENT -->
            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-blue-200 font-medium mb-3">Home / Guru</p>

                <h1 class="text-5xl font-black text-white">Data Guru</h1>

                <p class="text-gray-200 mt-4 max-w-2xl text-lg leading-8">
                    Daftar tenaga pendidik profesional yang membimbing dan
                    mendukung perkembangan peserta didik di sekolah kami.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <!-- HEADER -->
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-black text-gray-800">
                        Tenaga Pendidik
                    </h2>

                    <p class="mt-4 text-gray-500 max-w-2xl mx-auto leading-8">
                        Guru-guru terbaik yang berdedikasi dalam memberikan
                        pendidikan berkualitas dan membentuk karakter siswa.
                    </p>
                </div>

                <!-- GRID -->
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7"
                >
                    <div
                        v-for="teacher in teachers.data"
                        :key="teacher.id"
                        class="group bg-white rounded-[30px] overflow-hidden border border-gray-100 shadow-sm hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2"
                    >
                        <!-- PHOTO -->
                        <div
                            class="relative h-[320px] overflow-hidden bg-slate-100"
                        >
                            <img
                                v-if="teacher.photo"
                                :src="teacher.photo"
                                :alt="teacher.name"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                            />

                            <!-- FALLBACK -->
                            <div
                                v-else
                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100"
                            >
                                <span class="text-6xl font-black text-blue-400">
                                    {{ teacher.name.charAt(0) }}
                                </span>
                            </div>

                            <!-- OVERLAY -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"
                            ></div>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6 text-center">
                            <!-- NAME -->
                            <h3
                                class="text-xl font-black text-gray-800 leading-snug"
                            >
                                {{ teacher.name }}
                            </h3>

                            <!-- SUBJECT -->
                            <p
                                class="mt-3 inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-semibold"
                            >
                                {{ teacher.subject }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- EMPTY -->
                <div
                    v-if="teachers.data.length === 0"
                    class="bg-white rounded-3xl p-16 text-center border border-gray-100 mt-10"
                >
                    <h3 class="text-2xl font-black text-gray-800">
                        Belum ada data guru
                    </h3>

                    <p class="mt-3 text-gray-500">
                        Data tenaga pendidik akan tampil di sini.
                    </p>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
